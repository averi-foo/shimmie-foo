<?php

declare(strict_types=1);

namespace Shimmie2;

use function MicroHTML\{A, INPUT, LABEL, SMALL, TABLE, TD, TR, joinHTML};

use MicroHTML\HTMLElement;

class AveriUserPageTheme extends UserPageTheme
{
	public function display_login_page(): void
	{
		Ctx::$page->set_title("Login"); // Set page title
		
		$html = SHM_SIMPLE_FORM(make_link("user_admin/login"),
			TABLE(["summary" => "Login Form"],
				TR(
					TD(["width" => "70"], LABEL(["for" => "user"], "Name")),
					TD(["width" => "70"], INPUT(["type" => "text", "name" => "user", "id" => "user"]))
				),
				TR(
					TD(LABEL(["for" => "pass"], "Password")),
					TD(INPUT(["type" => "password", "name" => "pass", "id" => "pass"]))
				),
				TR(
					TD(["colspan" => "2"], SHM_SUBMIT("Log In"))
				)
			)
		);
		if (Ctx::$config->get(UserAccountsConfig::SIGNUP_ENABLED)) {
			$html->appendChild(SMALL(A(["href" => make_link("user_admin/create")], "Create Account")));
		}
		Ctx::$page->add_block(new Block("Login", $html, "main", 90));
	}
	
	/**
	 * @param array<int, array{name: string|HTMLElement, link: Url}> $parts
	 */
	public function display_user_links(User $user, array $parts): void
	{
		// no block in this theme
	}
	public function display_login_block(): void
	{
		// no block in this theme
	}
	
	/**
	 * @param array<array{name: string|HTMLElement, link: Url}> $parts
	 */
	public function display_user_block(User $user, array $parts): void
	{
		parent::display_user_block($user, $parts);
	}
	
	public function display_signup_page(): void
	{
		parent::display_signup_page();
	}
	
	/**
	 * @param array<\MicroHTML\HTMLElement|string> $stats
	 */
	public function display_user_page(User $duser, array $stats): void
	{
		parent::display_user_page($duser, $stats);
	}
	 }
