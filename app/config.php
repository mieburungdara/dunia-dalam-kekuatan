<?php

// F3 Configuration
$f3->set('DEBUG', 3);
ini_set('display_errors', 1);
error_reporting(E_ALL);

$f3->set('UI', 'application/views/'); // Beri tahu F3 di mana folder view berada
$f3->set('AUTOLOAD', 'app/'); // Tambahkan folder app ke autoloader

// Set a global application base URL
$f3->set('SCHEME', (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http'));
$f3->set('HOST', $_SERVER['HTTP_HOST']);
$f3->set('BASE','');

$app_base_url = $f3->get('SCHEME').'://'.$f3->get('HOST').$f3->get('BASE');
