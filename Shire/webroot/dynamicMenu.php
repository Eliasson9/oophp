<?php


//Class to handle nav menu
class CNavigation {
	//Generate the nav menu
	public static function GenerateMenu($items) {
		$html = "<nav>\n";
		foreach ($items as $item) {
			$html .= "<a href='{$item['url']}'>{$item['text']}</a>\n";
		}
		$html .= "</nav>\n";
		return $html;
	}
}
