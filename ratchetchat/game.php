<?php

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Evenement\EventEmitter;

use Apes\RoundHelper;
use Apes\RoundProcessor;
use Apes\EngineHelper;

// Make sure composer dependencies have been installed
require 'vendor/autoload.php';

if(isset( $argv[1] )) {
	$time = $argv[1];
}else{
	$time = 600;
}

if(isset( $argv[2] )) {
	$debug = true;
}else{
	$debug = false;
}

$loop = React\EventLoop\Factory::create();
$emit = new EventEmitter();
$helper = new EngineHelper();
$clients = new \SplObjectStorage();
$processor = new RoundProcessor();
$app = new Ratchet\App('localhost', 8080, '127.0.0.1' ,$loop);
$app->route('/xxxxxx', new Apes\GameEngine($loop, $emit, $clients, $processor, $helper, $time, $debug  ) );
$app->run();
