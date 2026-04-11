<?php
 
declare(strict_types=1);
 
namespace Shimmie2;
 
final class UserBiosPermissionsPermission extends PermissionGroup
{
	public const KEY = "edit_own_bio";
	public ?string $title = "Edit own bio";
	 
	#[PermissionMeta("Edit own bio")]
	public const EDIT_OWN_BIO = "edit_own_bio";
}
 
