<?php

class CTextFilter {

  function doFilter($text, $filter) {
    // Define all valid filters with their callback function.
    $valid = array(
      'bbcode'   => 'bbcode2html',
      'link'     => 'make_clickable',
      'markdown' => 'markdown',
      'nl2br'    => 'nl2br',  
    );

    // Make an array of the comma separated string $filter
    $filters = preg_replace('/\s/', '', explode(',', $filter));

    // For each filter, call its function with the $text as parameter.
    foreach($filters as $func) {
      if(isset($valid[$func])) {
        $text = $valid[$func]($text);
      } 
      else {
        throw new Exception("The filter '$filter' is not a valid filter string.");
      }
    }

    return $text;
  }


  function bbcode2html($text) {
    $search = array( 
      '/\[b\](.*?)\[\/b\]/', 
      '/\[i\](.*?)\[\/i\]/', 
      '/\[u\](.*?)\[\/u\]/', 
      '/\[img\](https?.*?)\[\/img\]/', 
      '/\[url\](https?.*?)\[\/url\]/', 
      '/\[url=(https?.*?)\](.*?)\[\/url\]/' 
      );   
    $replace = array( 
      '<strong>$1</strong>', 
      '<em>$1</em>', 
      '<u>$1</u>', 
      '<img src="$1" />', 
      '<a href="$1">$1</a>', 
      '<a href="$1">$2</a>' 
      );     
    return preg_replace($search, $replace, $text);
  }


  function make_clickable($text) {
    return preg_replace_callback(
      '#\b(?<![href|src]=[\'"])https?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#',
      create_function(
        '$matches',
        'return "<a href=\'{$matches[0]}\'>{$matches[0]}</a>";'
      ),
      $text
    );
  }


  function markdown($text) {
    $search = array(   
      '/(.*)\n={3,}\n/',
      '/(.*)\n-{3,}\n/',
      '/\#{6}(.*?)\n/',
      '/\#{5}(.*)\n/',
      '/\#{4}(.*)\n/',
      '/\#{3}(.*)\n/',
      '/\#{2}(.*)\n/',
      '/\#{1}(.*)\n/',
      '/\*{2}(.*?)\*{2}/',
      '/\*{1}(.*?)\*{1}/',
      '/\`(.*?)\`/',
      '/\[(.*?)\]\((.*?)\)/',
      '/(.*?)\n{2}/');

      $replace = array(
        '<h1>$1</h1>',
        '<h2>$1</h2>',
        '<h6>$1</h6>',
        '<h5>$1</h5>',
        '<h4>$1</h4>',
        '<h3>$1</h3>',
        '<h2>$1</h2>',
        '<h1>$1</h1>',
        '<strong>$1</strong>',
        '<em>$1</em>',
        '<code>$1</code>',
        '<a href="$2">$1</a>',
        '<p>$1</p>');

    return preg_replace($search, $replace, $text);;
  }

}