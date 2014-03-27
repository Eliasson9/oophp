<?php

function get_title($title) {
	global $shire;
	return $title.(isset($shire['title_append']) ? $shire['title_append'] : null);
}