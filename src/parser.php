<?php
// Max Base
// https://github.com/BaseMax/CoursesConfig
function startsWith($string, $startString) { 
	$len = strlen($startString); 
	return(substr($string, 0, $len) === $startString);
}
function pathise($title) {
	$title=str_replace([" ", "\t", "?", "!"], "-", trim($title));
	$title=str_replace("---", "-", $title);
	$title=str_replace(".", "-", $title);
	$title=str_replace(":", "-", $title);
	$title=str_replace("\"", "-", $title);
	$title=str_replace("'", "-", $title);
	$title=str_replace("â", "-", $title);
	$title=str_replace("$", "-", $title);
	$title=str_replace("€", "-", $title);
	$title=str_replace("™", "-", $title);
	$title=str_replace("_", "-", $title);
	$title=str_replace("&", "-", $title);
	$title=str_replace("(", "-", $title);
	$title=str_replace(")", "-", $title);
	$title=str_replace("--", "-", $title);
	$title=str_replace("---", "-", $title);
	$title=str_replace("--", "-", $title);
	$title=str_replace(".-", ".", $title);
	$title=str_replace("-.", ".", $title);
	if($title[strlen($title)-1] == "-") {
		$title=mb_substr($title, 0, -1);
	}
	return strtolower($title);
}
function lines2Str($lines) {
	$output="";
	foreach($lines as $line) {
		$output.=$line."\n";
	}
	return $output;
}
///////////////////////////////////////////////
$prefix="../out/";
$file=isset($argv[1]) ? $argv[1] : "../input.txt";
///////////////////////////////////////////////
$data=file_get_contents($file);
$items=explode("===", $data);
print_r($items);
$main_html="";
$main_html.="<h1>Courses</h1>";
foreach($items as $item) {
	$item=trim($item);
	$title=strtok($item, "\n");
	$path=pathise($title);
	$main_html.="<h2><a href=\"$path/\">$title</a></h2>";
	$dir=$prefix.$path."/";
	@mkdir($dir);
	$x=0;
	$y=1;
	$html="";
	$html.="<h1>$title</h1>";
	$pack=preg_replace('/^.+\n/', '', $item);
	// print $pack."\n\n...........\n";
	// preg_match_all('/\#(?<name>[^\n]+)\n(?<content>.*?)(\#|$)/si', $pack, $sections);
	// $sections=explode("#", $pack);
	// print_r($sections);
	// foreach($sections as $section) {
	// 	$section=trim($section);
	// 	if(startsWith($link, "#")) {
	// 		$sectionName=strtok($section, "\n");
	// 		$sectionContent=preg_replace('/^.+\n/', '', $section);
	// 		$links=explode("\n", $sectionContent);
	// 		$html.="<h2>$sectionName</h2>";
	// 	}
	// 	else {
	// 		$links=explode("\n", $section);
	// 	}
	// }
	$links=explode("\n", $pack);
	for($i=0;$i<count($links);$i++) {
		if($i != count($links)-1) {
			$nextLink=$links[$i+1];
		}
		$link=trim($links[$i]);
		print "==>".$link."\n";
		if(startsWith($link, "#")) {
			if($i != 0) {
				$html.="</ul>";
			}
			$link=trim(mb_substr($link, 1));
			$html.="<h2>$link</h2>";
			$html.="<ul>";
		}
		if(startsWith($link, "-")) {
			if($i == 0) {
				$html.="<ul>";
			}
			$link=trim(mb_substr($link, 1));
			$html.="<li><a href=\"$nextLink\">$link</a></li>";
			$y++;
		}
	}
	$html.="</ul>";
	file_put_contents($dir."index.html", $html);
}
file_put_contents($prefix."index.html", $main_html);
