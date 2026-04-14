<?php

declare(strict_types=1);

namespace Shimmie2;

use function MicroHTML\{A, BR, DIV, H2, H3, HR, INPUT, META, P, SPAN, SUP, emptyHTML};

use MicroHTML\HTMLElement;

class AveriIndexTheme extends IndexTheme
{
	public function display_intro(): void
	{
		$text = DIV(
			["class" => "prose"],
			P("No art is here yet, better upload some!")
		);
		Ctx::$page->set_title("Nothing here yet!");
		Ctx::$page->set_heading("Nothing here yet!");
		Ctx::$page->add_block(new Block("Nothing here yet!", $text, "main", 0));
	}
} 
