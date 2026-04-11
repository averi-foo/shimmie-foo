<?php

declare(strict_types=1);

namespace Shimmie2;

use function MicroHTML\{A, SMALL, TABLE, TR, TD, LABEL, INPUT};

class AveriUserTheme extends Themelet 
{
	public function display_login_page(): void
	{
		Ctx::$page->set_title("Login");
		Ctx::$page->set_layout("no-left");   // Removes the left sidebar so login takes full width
		
		$html = SHM_SIMPLE_FORM(make_link("user_admin/login"),
			TABLE(["summary" => "Login Form", "class" => "form"],
				TR(
					TD(["width" => "70"], LABEL(["for" => "user"], "Name")),
					TD(["width" => "70"], INPUT(["type" => "text", "name" => "user", "id" => "user", "required" => true]))
				),
				TR(
					TD(LABEL(["for" => "pass"], "Password")),
					TD(INPUT(["type" => "password", "name" => "pass", "id" => "pass", "required" => true]))
				),
				TR(
					TD(["colspan" => "2"], SHM_SUBMIT("Log In"))
				)
			)
		);
		
		// Add "Create Account" link
		if (Ctx::$config->get(UserAccountsConfig::SIGNUP_ENABLED)) {
			$html->appendChild(SMALL(A(["href" => make_link("user_admin/create")], "Create Account")));
		}
		
		Ctx::$page->add_block(new Block("Login", $html, "main", 90));
	}
} 
