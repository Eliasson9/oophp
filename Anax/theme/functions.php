<?php

function get_title($title) {
	global $anax;
	return $title.(isset($anax['title_append']) ? $anax['title_append'] : null);
}
