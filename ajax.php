<?php

ini_set('display_errors', true);
require_once 'config.php';
require_once 'utils.php';
require_once 'Net/SSH2.php';
require_once 'Crypt/RSA.php';
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

	if (!empty($config['key'])) {
		$key = new Crypt_RSA();
		if (!empty($config['keypass'])) {
			$key->setPassword($config['keypass']);
		}
		$keypass = $config['key'];
		if (file_exists($config['key'])) {
			$keypass = file_get_contents($config['key']);
		}
		if ($key->loadKey($keypass)) {
			$session->login($config['user'], $key);
		}
	}
	if (!$session->isConnected()) {
		$session->login($config['user'], $config['pass']);
	}

	if ($session->isConnected()) {
		if ($_POST['action'] == 'status') {
			echo ansi2html($session->exec('bash -c \'cd ' . $config['path'] . ' && ' . $gitstatus . "'"));
			exit;
		} else if ($_POST['action'] == 'push') {
			$message = empty($_POST['message']) ? 'FTP' : str_replace(array('"', "'"), ' ', stripslashes($_POST['message']));
			echo ansi2html($session->exec('bash -c \'cd ' . $config['path'] . ' && git add -A && git commit -m "' . $message . '" && git push && git push && ' . $gitstatus . "'"));
			exit;
		} else if ($_POST['action'] == 'pull') {
			echo ansi2html($session->exec('bash -c \'cd ' . $config['path'] . ' && git pull && ' . $gitstatus . "'"));
			exit;
		} else {
			echo 'Unknown command ' . $_POST['action'];
			exit;
		}
	} else {
		echo 'Permission denied, please try again.';
		exit;
	}
}

echo 'error';
