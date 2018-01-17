<?php

// http://php.net/manual/en/features.commandline.webserver.php

$extensions = [
	'css' 	=> 'text/css',
	'html' 	=> 'text/html',
	'js' 	=> 'application/javascript',
	'woff' 	=> 'application/font-woff',
	'woff2' 	=> 'application/font-woff2',
	'png' 	=> 'image/png'
];

$folders = ['bower_components', '.tmp'];

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$ext = pathinfo($path, PATHINFO_EXTENSION);

if($path[0] === '/') {
	$path = substr($path, 1);
}

$serve_assets = false;

foreach($folders as $folder) {
	$serve_assets = $serve_assets || strpos($path, $folder) == 0;
}

$serve_assets = $serve_assets &&
				isset($extensions[$ext]) &&
				file_exists($path);

if($serve_assets) {
	header('Content-Type: ' . $extensions[$ext]);
	echo file_get_contents($path);
}

return $serve_assets;

