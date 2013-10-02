<?php

require_once 'config/config.php';
require_once 'config/color.php';
require_once 'Net/SSH2.php';
global $servers;

if (!empty($_POST['section'])) {
	foreach ($servers as $ssh) {
		if (array_key_exists($_POST['section'], $ssh)) {
			$config = $ssh[$_POST['section']];
			break;
		}
	}
}

if (!empty($_POST['action'])) {
	$session = new Net_SSH2($config['host'], $config['port']);
	if ($session->login($config['user'], $config['pass'])) {
		if ($_POST['action'] == 'status') {
			echo ansi2html($session->exec('cd ' . $config['path'] . ' && git fetch && git status'));
		} else if ($_POST['action'] == 'push') {
			$message = empty($_POST['message']) ? 'FTP' : $_POST['message'];
			//echo $session->exec('cd ' . $config['path'] . ' && git add -A && git commit -m "' . $message . '" && git push');
		} else if ($_POST['action'] == 'pull') {
			//echo $session->exec('cd ' . $config['path'] . ' && git pull');
		}
	}
}
