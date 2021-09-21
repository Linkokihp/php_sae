<?php
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

    // Make sure composer dependencies have been installed
    require 'vendor/autoload.php';
/**
 * chat.php
 * Send any incoming messages to all connected clients (except sender)
 */
class MyChat implements MessageComponentInterface {
    protected $clients; 

    public function __construct(React\EventLoop\LoopInterface $loop) {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);
    }

    public function onMessage(ConnectionInterface $from, $msg) {
    	// put the message into an array
        foreach ($this->clients as $client) {
            if ($from != $client) {
                $client->send($msg);
            }
        }
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        $conn->close();
    }
}

$loop = React\EventLoop\Factory::create();

// Run the server application through the WebSocket protocol on port 8080
$app = new Ratchet\App('localhost', 8080, '127.0.0.1' ,$loop);
$app->route('/chat', new MyChat($loop));
$app->route('/echo', new Ratchet\Server\EchoServer, array('*'));
$app->run();

