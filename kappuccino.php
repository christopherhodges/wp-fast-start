<?php

$host = $_SERVER['HTTP_HOST'];

// Vagrant
if('domain.dev' === $host){
	define('DB_NAME',       '');
	define('DB_USER',       '');
	define('DB_PASSWORD',   '');
	define('DB_HOST',       'localhost');
	define('WP_DEBUG',      true);
}else

// Dev
if('' === $host){
	define('DB_NAME',       '');
	define('DB_USER',       '');
	define('DB_PASSWORD',   '');
	define('DB_HOST',       'localhost');
	define('WP_DEBUG',      true);
}

// Prod
else{
	define('DB_NAME',       '');
	define('DB_USER',       '');
	define('DB_PASSWORD',   '');
	define('DB_HOST',       'localhost');
	define('WP_DEBUG',      true);
}


define('WP_HOME',       'http://'.$host);
define('WP_SITEURL',    'http://'.$host);

// Si l'on ne souhaite pas utiliser /wp-content mais /data comme dossier
define ('WP_CONTENT_FOLDERNAME',   '/data');
define ('WP_CONTENT_DIR',          ABSPATH . WP_CONTENT_FOLDERNAME) ;
define ('WP_CONTENT_URL',          WP_SITEURL . WP_CONTENT_FOLDERNAME);

// Désactive le cron interne ... il faut le lancer depuis l'extérieur
#	define('DISABLE_WP_CRON', true);

// Active le debug
error_reporting(E_ERROR | E_PARSE);
#if(true === WP_DEBUG) error_reporting(E_ERROR | E_PARSE | E_NOTICE);

// Interdit l'installation d'un plugin depuis l'admin et l'edition des fichiers
#	define('DISALLOW_FILE_MODS', true);
#	define('DISALLOW_FILE_EDIT', true);



// Du plus
#	define('FS_CHMOD_FILE', 0755);
#	define('FS_CHMOD_DIR', 0644);
#	define('AUTOSAVE_INTERVAL', 120);
#	define('WP_POST_REVISIONS', 5);
#	define('WP_MEMORY_LIMIT', '64M');

// https://api.wordpress.org/secret-key/1.1/salt/

// ... 
