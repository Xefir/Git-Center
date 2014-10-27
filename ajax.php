<?php

ini_set('display_errors', true);
require_once 'config.php';
require_once 'utils.php';
require_once 'Net/SSH2.php';
require_once 'Crypt/RSA.php';
global $servers, $config;

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
	if (!$session->isConnected() && isset($config['pass'])) {
		$session->login($config['user'], $config['pass']);
	}

	if ($session->isConnected()) {
		$operator = !empty($config['operator']) ? ' ' . $config['operator'] . ' ' : ' && ';
		$gitstatus = 'git fetch' . $operator . 'git status';

		if ($_POST['action'] == 'status') {
			echo ansi2html($session->exec('cd ' . $config['path'] . $operator . $gitstatus));
			exit;
		} else if (strpos($_POST['action'], 'push') !== false) {
			if (strpos($_POST['action'], 'force') !== false) {
				echo ansi2html($session->exec('cd ' . $config['path'] . $operator . 'git push' . $operator . $gitstatus));
				if (!empty($config['after_push'])) {
					echo ansi2html($session->exec('cd ' . $config['path'] . $operator . $config['after_push']));
				}
			} else {
				$message = empty($_POST['message']) ? 'FTP' : str_replace(array('"', "'"), ' ', stripslashes($_POST['message']));
				echo ansi2html($session->exec('cd ' . $config['path'] . $operator . 'git add -A' . $operator . 'git commit -m "' . $message . '"' . $operator . 'git push' . $operator . $gitstatus));
				if (!empty($config['after_push'])) {
					echo ansi2html($session->exec('cd ' . $config['path'] . $operator . $config['after_push']));
				}
			}
			exit;
		} else if ($_POST['action'] == 'pull') {
			echo ansi2html($session->exec('cd ' . $config['path'] . $operator . 'git pull' . $operator . $gitstatus));
			if (!empty($config['after_pull'])) {
				echo ansi2html($session->exec('cd ' . $config['path'] . $operator . $config['after_pull']));
			}
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
