<?php

declare(strict_types=1);

namespace Shimmie2;

final class UserBiosPermissionsInfo extends ExtensionInfo
{
	public const KEY = "user_bios_permissions";
	public string $name = "User Bios Permissions";
	public array $authors = ["Lachlan","A Clanker"];
	public string $description = "Adds permission control for editing user biographies";
	public array $dependencies = ["biography"];
}
