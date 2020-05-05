<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('js')) {
 function js($js) {
 	if(!empty($js)){
            foreach($js as $e) {
                $element = '<script defer src="' . $e . '"></script>
                ';
                echo $element;
            }
        }
 }
}


if ( ! function_exists('css')) {
 function css($css) {
 	if(!empty($css)){
            foreach($css as $e) {
                $element = '<link rel="stylesheet" href="' . $e . '"/>
                ';
                echo $element;
            }
        }
 }
}