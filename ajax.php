<?php

require_once 'config/config.php';
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
	$session = ssh2_connect($config['host'], $config['port']);
	ssh2_auth_password($session, $config['user'], $config['pass']);
	if ($_POST['action'] == 'status') {
		$output = ssh2_exec($session, 'cd ' . $config['path'] . ' && git fetch && git status');
	} else if ($_POST['action'] == 'push') {
		$message = empty($_POST['message']) ? 'FTP' : $_POST['message'];
		$output = ssh2_exec($session, 'cd ' . $config['path'] . ' && git add -A && git commit -m "' . $message . '" && git push');
	} else if ($_POST['action'] == 'pull') {
		$output = ssh2_exec($session, 'cd ' . $config['path'] . ' && git pull');
	}

	$pre = stream_get_contents($output);
}

echo json_encode(array('pre' => $pre));
