<?php

/* Copiez coller ce fichier en config.php pour executer correctement Git Center */

// TRUE : Sécurité si vous executez Git Center sur un serveur GitLab
define('ONGITLAB', false);

// Définition de la forêt de serveurs
$servers = array(
	'Groupe de serveur 1' => array(
		'prod1' => array(
			'title' => 'Production de la mort',
			'host' => '192.168.1.10',
			'port' => 22,
			'user' => 'root',
			'pass' => 'root',
			'path' => '/home/user/root'
		),
		'test1' => array(
			'title' => 'Test de la mort',
			'host' => '192.168.1.20',
			'port' => 22,
			'user' => 'user',
			'pass' => 'blbl',
			'path' => '/home/user/test'
		),
		'prod2' => array(
			'title' => 'Production de la mort',
			'host' => '192.168.1.30',
			'port' => 22,
			'user' => 'root',
			'pass' => 'root',
			'path' => '/home/user/root'
		)
	),
	'Groupe de serveur 2' => array(
		'prod3' => array(
			'title' => 'Production de la mort',
			'host' => '192.168.1.40',
			'port' => 22,
			'user' => 'root',
			'pass' => 'root',
			'path' => '/home/user/root'
		),
		'test3' => array(
			'title' => 'Test de la mort',
			'host' => '192.168.1.40',
			'port' => 22,
			'user' => 'user',
			'pass' => 'blbl',
			'path' => '/home/user/test'
		),
		'prod4' => array(
			'title' => 'Production de la mort',
			'host' => '192.168.1.50',
			'port' => 22,
			'user' => 'root',
			'pass' => 'root',
			'path' => '/home/user/root'
		)
	)
);
