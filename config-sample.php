<?php

/* Copiez coller ce fichier en config.php pour executer correctement Git Center */

/*
 * "'dev' => false" permet de cacher la fonction pour Commit et Push (exemple appli1)
 *
 * Dans le cas d'une connexion avec une clef RSA (clef privée) :
 * -- Le mot de passe SSH (pass) est facultatif et sera utilisé en car de refus de connexion avec la clef
 * -- Le keypass est le mot de passe de la clef (laissez vide ou omettez pas le champ si vous n'avez pas mis de keypass)
 * -- Le key est votre clef privée qui peut être soit un chemin (absolu ou relatif) vers le fichier id_rsa soit LA FUCKING CLEF PRIVÉE EN DUR !!!
 *																												 ^ OUI ÇA FONCTIONNE OMGWTFBBQ11
 */
// Définition de la forêt de serveurs
$servers = array(
	'Groupe de serveur 1' => array(
		'prod1' => array(
			'title' => 'Production de la mort',
			'host' => '192.168.1.10',
			'port' => 22,
			'user' => 'root',
			'pass' => 'root',
			'path' => '/home/user/root',
			'after_push' => 'php -f TAMERE.php',
			'operator' => '&&' # bash style
		),
		'test1' => array(
			'title' => 'Test de la mort',
			'host' => '192.168.1.20',
			'port' => 22,
			'user' => 'user',
			'pass' => 'blbl',
			'path' => '/home/user/test',
			'after_pull' => 'php -f TONPERE.php',
			'operator' => '; and' # fish style
		),
		'prod2' => array(
			'title' => 'Production de la mort',
			'host' => '192.168.1.30',
			'port' => 22,
			'user' => 'root',
			'pass' => 'partoutatiss',
			'path' => '/home/user/root'
		),
		'appli1' => array(
			'title' => 'Appli que je ne dev pas',
			'host' => '192.168.1.60',
			'port' => 22,
			'user' => 'pouet',
			'pass' => 'pasfinicc',
			'path' => '/home/user/pouet',
			'dev' => false
		)
	),
	'Groupe de serveur 2 conf RSA' => array(
		'prod3' => array(
			'title' => 'Production de la mort',
			'host' => '192.168.1.40',
			'port' => 22,
			'user' => 'root',
			'pass' => 'root',
			'key' => '/Users/tamere/.ssh/id_rsa',
			'keypass' => 'rootdelaclefrsa',
			'path' => '/home/user/root'
		),
		'test3' => array(
			'title' => 'Test de la mort',
			'host' => '192.168.1.40',
			'port' => 22,
			'user' => 'user',
			'key' => '-----BEGIN RSA PRIVATE KEY-----
MIIEpAIBAAKCAQEAw/scCsz9rtp+2VzUwpkdqNHPy6vqS72qvy3dt04U0rHj6NVv
/L+zF3M0EfULpNAB6D5XY35D854IKZ/Dwcp1/2xjPkLJ+XaLl38TUStLfMQA8EgR
EVzW5QrAte8xZOF35lyfoi5HBQay8R3d3SqIoRFzINEpWHtwlIHbf6CACQ1Rgx2J
gQo1/i8gu2xzp7T04cGSWguCEKbQsDqLTHNGYTDl2fTJki9b3NE6Fm+0/qp87pPq
YVNqapwPYlVDpmql4kcomPKnBzo3/ThFXeq5iwJMKwTgqnVUIttKTKJ1/HB83VPM
n/+FR+hwkcqtgSiPLI9ddtsRikO1auG8h1aB3wIDAQABAoIBAHgkSFyWri2y5HB7
6DIji3sipDBHg6pK65GnnHPy+fDv/LePoMdg/XkytokLn8e5fHHTRd9IWH/QMVDT
ED6Mzyl2WKCicQ7tDUYiMMVhtTUXMzwZ8dyi/VoL7Xea2rztO4OM5I+XrxH1uVz2
4jvjBz82Y02K673CbpGbyePDkLn6yzlmRpEOFEwH+169a44i/gV4HcC3Vo7ULX74
SP/yOGcvBD7e9t1BgELmcLn+Y5EhOVQT6O3hRW20CSnA4yQ+fe2KhCM2EJRlZ88S
uuXK2GSEMLmv0+W+GCQHskUEBQRtCfteYHYXZmJwhLgYuUZXUy2SYHuNNO01x3lG
reGvTgECgYEA/xpW5fUjb1KAYAr+/ETzsYk3/v72akQSuYVV5cpre0+wg+RJNa3E
adhpIqKz8l4BhXB5d93cxMNr7x3q+hVFeCsgRcMVLSf3fFPx3uw6stCxt2c6lvQm
/RP6KsE7OG4Vse47tKE1Jop4JIHlbNkIWdrxbUDsRM/OHDsfR/pFBvECgYEAxKuL
Z8GZqqvpBZDEQ2s55WUJz1lRGJNQuVopabZCkOVpRNCkM15MYDLaj1gcOMrWXtZp
LEHyFtNf5cLfcwdL6AGFysoTYltMIwLs0sOetMNO6p8ViyEjbphpsq5vOw4wSgOI
eIPJeZesMu1ZrB6W68fYXm7wOVeZqMqImmx2Nc8CgYEAo0lbyBPSG6aGT3OaZSVJ
iyEW+5x9Y+WwyplDMzQO+j428SVFixtv9oQ0P5w/bGqptJ0a0xPrBPNFeif/SRYm
glWwcZb+TgogCq+8yQESTXTx3EAyK3+aGTIZVhabbnJgZqTkCKmLWOEXJ98RWEvP
YZyYHmOJGD6fYkihrDPQzTECgYBMaXY9dtv0ktxznB6VLzkMZqhcFpDKopoPmfdT
KkxMrcWrxgC2MKIuEjQW054Ldsu5h0bPukOMGM4+n+tfbutQFh9cfgzv/xbi14Ua
EoU8KFImGG8vYk2476DJmrp+0HF0oFDKujFye7qdAtj/ZdcvfrMTZbkSHnYGPcK7
dP6swwKBgQDT95rsxbXPtpA03H46GpVeBYJ5ARepPpObrilYxkt5LymncAJykAvr
KW6dcEHI6KsqCFJz+jqUeuKEM9yHn23UtvxiUDEtdbRJ6yKIhJzwG/c/ZOxWlIVR
PLBLwUI2uDV8cMCdDfEYMxkBbMHP4L2IDKjEIznGRIw386Cq2LsOmg==
-----END RSA PRIVATE KEY-----',
			'path' => '/home/user/test'
		),
		'prod4' => array(
			'title' => 'Production de la mort',
			'host' => '192.168.1.50',
			'port' => 22,
			'user' => 'root',
			'pass' => 'blbl',
			'path' => '/home/user/root'
		)
	)
);
