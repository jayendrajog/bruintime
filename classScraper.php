<?php

	$url = "http://www.registrar.ucla.edu/schedule/detselect.aspx?termsel=15F&subareasel=COM+SCI&idxcrs=0033++++";
	$output = file_get_contents($url);
	strip_tags($output);
	$output = get_string_between("$output", 'Textbooks', 'About Us');
	$output = preg_replace("/<img[^>]+\>/i", "", $output); 
	echo $output; 

	function get_string_between($string, $start, $end){
	    $string = " " . $string;
	    $ini = strpos($string,$start);
	    if ($ini == 0) return "";
	    $ini += strlen($start);
	    $len = strpos($string,$end,$ini) - $ini;
	    return substr($string,$ini,$len);
	}

?>