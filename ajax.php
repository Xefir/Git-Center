<?php

ini_set('display_errors', true);
require_once 'config.php';
require_once 'utils.php';
require_once 'Net/SSH2.php';
global $servers;
$gitstatus = 'git fetch && git status';

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
			echo ansi2html($session->exec('bash -c \'cd ' . $config['path'] . ' && ' . $gitstatus . "'"));
		} else if ($_POST['action'] == 'push') {
			$message = empty($_POST['message']) ? 'FTP' : $_POST['message'];
			echo ansi2html($session->exec('bash -c \'cd ' . $config['path'] . ' && git add -A && git commit -m "' . addslashes($message) . '" && git push && ' . $gitstatus . "'"));
		} else if ($_POST['action'] == 'pull') {
			echo ansi2html($session->exec('bash -c \'cd ' . $config['path'] . ' && git pull && ' . $gitstatus . "'"));
		}
	}
}
