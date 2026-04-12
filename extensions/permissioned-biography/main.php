<?php

declare(strict_types=1);

namespace Shimmie2;

final class UserBiosPermissions extends Extension
{
	public const KEY = "user_bios_permissions";
	
	public const EDIT_OWN_BIO = "edit_own_bio";
	
	/**
	 * Runs after the original Biography extension
	 * and restricts the edit form + save action.
	 */
	#[EventListener(priority: 5)]   // Higher priority = runs later
	public function onUserPageBuilding(UserPageBuildingEvent $event): void
	{
		$current_user = Ctx::$user;
		$display_user = $event->display_user;
		
		$is_own_profile = ($current_user->id === $display_user->id);
		$has_edit_any = $current_user->can(UserAccountsPermission::EDIT_USER_INFO);
		$has_edit_own = $current_user->can(self::EDIT_OWN_BIO);
		
		// Only show composer (edit box) if they have permission
		if (($is_own_profile && $has_edit_own) || $has_edit_any) {
			$bio = $display_user->get_config()->get(BiographyConfig::BIOGRAPHY) ?? "";
			(new BiographyTheme())->display_composer($display_user, $bio);
		} else {
			$bio = $display_user->get_config()->get(BiographyConfig::BIOGRAPHY) ?? "";
			(new BiographyTheme())->display_biography($bio);
		}
	}
	
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
