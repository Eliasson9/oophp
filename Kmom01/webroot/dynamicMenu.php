<?php


//Class to handle nav menu
class CNavigation {
	//Generate the nav menu
	public static function GenerateMenu($menu) {
		$html = "<nav class='topNav'>\n";
		foreach ($menu['items'] as $item) {
			$selected = $menu['callback_selected']($item['url']) ? 'selected' : null;
			$html .= "<a href='{$item['url']}' class='$selected'>{$item['text']}</a>\n";
		}
		$html .= "</nav>\n";
		return $html;
	}
}
