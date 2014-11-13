<?php

function ansi2html($string)
{
	$dictionary = array(
		'[30m' => '<span style="color:black">',
		'[31m' => '<span style="color:red">',
		'[32m' => '<span style="color:green">',
		'[33m' => '<span style="color:yellow">',
		'[34m' => '<span style="color:blue">',
		'[35m' => '<span style="color:fuchsia">',
		'[36m' => '<span style="color:aqua">',
		'[37m' => '<span style="color:white">',
		'[m' => '</span>',
	);

	return str_replace(array_keys($dictionary), $dictionary, $string);
}
