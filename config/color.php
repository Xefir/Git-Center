<?php

function ansi2html($string) {
	$dictionary = array(
		'[30m' => '<span style="color:blue">',
		'[31m' => '<span style="color:blue">',
		'[32m' => '<span style="color:blue">',
		'[33m' => '<span style="color:blue">',
		'[34m' => '<span style="color:blue">',
		'[35m' => '<span style="color:blue">',
		'[36m' => '<span style="color:blue">',
		'[37m' => '<span style="color:blue">',
		'[m' => '</span>',
	);

	return str_replace(array_keys($dictionary), $dictionary, $string);
}
