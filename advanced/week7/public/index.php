<?php
//Require needed files
require_once '../vendor/autoload.php';

//Initialize bootstrap & render the application
$bootstrap = new MusicCollection\Bootstrap\WebBootstrap();
echo $bootstrap->render();
