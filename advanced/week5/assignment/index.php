<?php
//Require needed files
require_once 'includes/config/settings.php';
require_once 'vendor/autoload.php';

//Initialize bootstrap & render the application
$bootstrap = new \System\Bootstrap\WebBootstrap();
echo $bootstrap->render();

