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
	$title=str_replace("--", "-", $title);
	$title=str_replace("---", "-", $title);
	$title=str_replace(".-", ".", $title);
	$title=str_replace("-.", ".", $title);
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
$prefix="out/";
$file=isset($argv[1]) ? $argv[1] : "../links.txt";
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
			$episode=pathise($link.".mp4");
			$direct="$x-$y-$episode";
			$html.="<li><a href=\"$direct\">$link</a></li>";
			$direct=$dir.$direct;
			$video="$dir$x-$y-$episode";
			// rename("$prefix$x-$y.mp4", $direct);
			if(!file_exists($video)) {
				// Download `$nextLink` and save at `$video`
				print "Create $video from $nextLink\n";
			}
			$y++;
		}
	}
	$html.="</ul>";
	file_put_contents($dir."index.html", $html);
}
file_put_contents($prefix."index.html", $main_html);
