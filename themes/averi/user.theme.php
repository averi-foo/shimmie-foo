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
		$this->display_navigation(); // Display navbar on left
		$html = $this->create_login_block();
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
	
	public function create_login_block(): HTMLElement
	{
		$captcha = Captcha::get_html(UserAccountsPermission::SKIP_LOGIN_CAPTCHA);
		
		$form = SHM_SIMPLE_FORM(
			make_link("user_admin/login"),
			TABLE(["style" => "width: 50%", "class" => "form"],
			TBODY(
			TR(
				TH(LABEL(["for" => "user"], "Name")),
				TD(INPUT(["id" => "user", "type" => "text", "name" => "user", "autocomplete" => "username", "required" => true]))
			),
		   TR(
				TH(LABEL(["for" => "pass"], "Password")),
				TD(INPUT(["id" => "pass", "type" => "password", "name" => "pass", "autocomplete" => "current-password", "required" => true]))
		   ),
		   $captcha ? TR(
			   TH(LABEL(["for" => "captcha"], "Captcha")),
				TD($captcha)
		   ) : null
			),
			  TFOOT(
				  TR(TD(["colspan" => "2"], INPUT(["type" => "submit", "value" => "Log In"])))
			  )
			)
		);
		
		$html = emptyHTML();
		$html->appendChild($form);
		if (Ctx::$config->get(UserAccountsConfig::SIGNUP_ENABLED) && Ctx::$user->can(UserAccountsPermission::CREATE_USER)) {
			$html->appendChild(SMALL(A(["href" => make_link("user_admin/create")], "Create Account")));
		}
		
		return $html;
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
