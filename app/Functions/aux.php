<?php


/**
 * Replace with regex json in HTML template
 *
 * @return string
 */
function replace_tags_json($json, $html_template){
  foreach ($json as $key => $value){
    $pattern = '/\$\$\$(' . $key . ')\$\$\$/';
    $html_template = preg_replace($pattern, $value, $html_template);
  }
  foreach ($json as $key => $value){
    $pattern = '/\#\#\#(' . $key . ')\#\#\#/';
    $html_template = preg_replace($pattern, $value, $html_template);
  }
  return $html_template;
}


