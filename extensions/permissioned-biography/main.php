<?php

declare(strict_types=1);

namespace Shimmie2;

final class UserBiosPermissions extends Extension
{
	public const KEY = "user_bios_permissions";
	
	public const EDIT_OWN_BIO = "edit_own_bio";
	
	#[EventListener(priority: 5)]
	public function onPageRequest(PageRequestEvent $event): void
	{
		if ($event->page_matches("user/{name}/biography", method: "POST")) {
			$duser = User::by_name($event->get_arg("name"));
			$current_user = Ctx::$user;
			
			$is_own = ($current_user->id === $duser->id);
			$has_edit_any = $current_user->can(UserAccountsPermission::EDIT_USER_INFO);
			$has_edit_own = $current_user->can(self::EDIT_OWN_BIO);
			
			if (!($is_own && $has_edit_own) && !$has_edit_any) {
				throw new PermissionDenied("You do not have permission to edit this biography.");
			}
			
			// If we reach here, permission is granted → let original handler run
		}
	}
} 
