<?php
require './vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

ob_start();
require('index.php');
$page = ob_get_contents();
ob_end_clean();
$path = "public/index.html";
file_put_contents($path, $page);

// copy('favicon.png', 'public/favicon.png');
// copy('style.css', 'public/style.css');
// copy('flash.js', 'public/flash.js');
