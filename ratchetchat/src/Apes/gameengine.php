<?php

namespace Apes;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use React\EventLoop\LoopInterface;
use Evenement\EventEmitter;
use React\Promise\Deferred;
use React\EventLoop\Factory;
use Guzzle\Http\Message\Response;
use Apes\RoundProcessor;
use Underscore\Types\Arrays;
use Underscore\Types\Object;
use Apes\EngineHelper;

use Apes\Say;

require 'vendor/autoload.php';

class GameEngine implements MessageComponentInterface
{
	public $clients;
    public $disconnected;

    protected $roundProcessor;

    protected $roundTimer;
    protected $gameStarted = false;
    protected $roundInProgress = false;
    protected $tiebreakerInProgress = false;
    protected $emit;
    protected $loop;
    protected $helper;
    protected $time;
    public $say;

    private $playerCount = 0;
    private $debug = false;
    
    private $roundNumber;
    private $currentRoundTime = 0;

    public function __construct( LoopInterface $loop, EventEmitter $emit, \SplObjectStorage $clients,  RoundProcessor $roundProcessor, EngineHelper $helper, $time=60, $debug=false )
    {

        $this->debug = $debug;

        $this->helper = $helper;
        $this->emit = $emit;
        $this->loop = $loop;
        $this->roundTimer = new RoundTimer($loop, $emit);
        $this->roundNumber = 0;

        $this->clients = $clients;
        $this->disconnected = new \SplObjectStorage;
        $this->time = $time;
        $that = $this;

        $this->say = new Say( $this->clients );
        $this->roundProcessor = $roundProcessor;
        $players = new Say( $this->clients );

        
        // Setup listeners on the roundTimer object.
        $emit->on('GAME.COUNTDOWN', function () use ($that) {

            if( $this->playerCount !== $this->clients->count()){
                $this->playerCount = $this->clients->count();
                $this->say->to( $this->clients )->that( Say::TICK, [ "players" => $this->playerCount ] );
            }

        });

        // Setup listeners on the roundTimer object.
        $emit->on('GAME.COUNTDOWN_END', function () use ($that, $loop, $emit) {
            $this->say->to( $this->clients )->that( Say::GAME_STARTING, ["players"=>$this->clients->count() ] );
            $this->setGameStarted(true);
            $loop->addTimer(3, function() use ($loop, $emit){

                $this->startRound($loop,$emit);
            });
        });

        $this->roundTimer->startCountDown($this->time);

    }


    /**
     * Starts the game play cycle off.
     * @return [type] [description]
     */
    public function startRound()
    {   
        $this->resetClients();

        // If only one player - they win
        if( $this->clients->count() == 1 ){
            $this->say->to($this->clients)->that( Say::YOU_HAVE_WON , [ "wincode" => "winning_code" ]);
            
            // Wait 60 seconds and then close the game.
            $this->loop->addTimer(60, function(){
                exit();
            });
            return;
        }

        // If two, go to tiebreaker.
        if( $this->clients->count() == 2 ){
            $this->startTieBreaker();
            return;
        }

        // add a second timer to track the round.
        $this->currentRoundTime = 10;
        
        $this->roundNumber++;
        $this->say->to($this->clients)->that( Say::ROUND_START,  [ "players" => $this->clients->count(), "round" => $this->roundNumber, 'countdown'=>$this->currentRoundTime ] );
        $this->roundInProgress = true;


        $timer = null;
        $timer = $this->loop->addPeriodicTimer(1, function() use (&$timer) {
            if( $this->currentRoundTime < 1 ){
                $timer->cancel();
                return;
            }
            $this->currentRoundTime--;
        });

        $this->loop->addTimer(10, function(){
            $this->roundInProgress = false;
            $this->say->to($this->clients)->that( Say::ROUND_END );
            $this->calculateRound($this->clients);
        });


    }

    /**
     * Start a tiebreaker round
     * @return [type] [description]
     */
    public function startTieBreaker()
    {
        $this->say->to($this->clients)->that(Say::TIEBREAKER_START);
        $this->tiebreakerInProgress = true;
        $this->loop->addTimer(10, function(){
            $this->tiebreakerInProgress = false;
            // process the results of the tiebreaker here.
            $loser = $this->roundProcessor->processTiebreaker( $this->clients );
            $this->say->say($loser, Say::YOU_HAVE_LOST );
            $this->clients->detach($loser);
            $this->loop->addTimer(1, function() use ($loser){
                $loser->close();
            });
            $this->say->to($this->clients)->that( Say::YOU_HAVE_WON , [ "wincode" => "winning_code" ]);
            // Wait 60 seconds and then close the game.
            $this->loop->addTimer(60, function(){
                exit();
            });
        });


    }

    /**
     * process rounds
     * @return [type] [description]
     */
    public function calculateRound(){

        // Handle losers of this round.
        $losersList = $this->roundProcessor->process( $this->clients );

        $loserCount = $losersList->count();
        $this->clients->removeAll( $losersList );
        $winnerCount = $this->clients->count();  

        $this->say->to($losersList)->that( Say::YOU_HAVE_LOST,  [ "winners" => $winnerCount, "losers"=> $loserCount ] );
        
        $this->loop->addTimer(2, function() use ($losersList, $winnerCount, $loserCount){

            $this->say->to($losersList)->that( Say::DISCONNECTING );
            $this->disconnectClients( $losersList );

            $winnerList = $this->clients;

            if( $winnerCount > 2 )
            {
                $this->say->to($winnerList)->that( Say::CORRECT_ANSWER,  [ "winners" => $winnerCount, "losers"=> $loserCount ] );
                $this->countDownToRoundStart();
            } 
            elseif ( $winnerCount == 2 ) 
            {
                //$this->say->to($winnerList)->that( Say::CORRECT_ANSWER,  [ "winners" => $winnerCount, "losers"=> $loserCount ] );
                $this->say->to($winnerList)->that(Say::TIEBREAKER_START, [ "winners" => $winnerCount, "losers"=> $loserCount ] );
                $this->startTieBreaker();
            }
            elseif ( $winnerCount == 1 )
            {
                $this->say->to($winnerList)->that( Say::CORRECT_ANSWER,  [ "winners" => $winnerCount, "losers"=> $loserCount ] );
                $this->say->to($winnerList)->that( Say::YOU_HAVE_WON , [ "wincode" => "winning_code" ]);

                // SEND WIN CODE

                // Wait 60 seconds and then close the game.
                $this->loop->addTimer(60, function(){
                    exit();
                });
            } 
            else{
                // TODO --------------------------------------
                // WINNER HAS DISCONNECTED??? 
                // WHAT CAN BE DONE
                // COULD WE STORE TOKEN AND ALLOW A RECONNECT?
                // -------------------------------------------
            }
        });   
    }

    public function countDownToRoundStart()
    {
        $this->loop->addTimer(5, function(){
            $this->startRound();
        });
    }

    /**
     * When a new connection is opened it will be passed to this method
     * @param  ConnectionInterface $conn The socket/connection that just connected to your application
     * @throws \Exception
     */
    function onOpen( ConnectionInterface $conn )
    {
        // echo "incoming connection".PHP_EOL;
        $newPlayer = $this->say->to( $this->clients );
        $helper = $this->helper;
        $reconnect = false;

        // if a game is in progress don't allow any further user.
        if( $this->gameStarted ){

            // check to see if the token matches any tokens currently connected.
            $token = $helper->getDataKey($conn, 'token');
            $reconnect = $helper->checkIfDisconnected($token, $this->disconnected );

            if(!$reconnect){
                $this->say->sayError( $conn, Say::GAME_IN_PROGRESS );
                // kick the connection.
                $this->closeConnection($conn);
                return;
            }
        }

        // get the token.
        $token = $helper->getDataKey($conn, 'token');
        if(!$token){
            $this->say->sayError( $conn, Say::NO_TOKEN );
            return;
        }

        // attach data.
    	$this->clients->attach($conn, $helper->getDataObject(null, $token) );
        if($reconnect){
            $newPlayer->say( $conn, Say::RECONNECTING, [ 'countdown'=>$this->currentRoundTime , "round" => $this->roundNumber, 'players' => $this->clients->count() ] );
        }else{
            $newPlayer->say( $conn, Say::CONNECTED, [ 'countdown'=>$this->roundTimer->getCountdown(), "round" => $this->roundNumber, 'players' => $this->clients->count() ] );

        }

    }

    /**
     * Triggered when a client sends data through the socket
     * @param  \Ratchet\ConnectionInterface $from The socket/connection that sent the message to your application
     * @param  string                       $msg  The message received
     * @throws \Exception
     */
    function onMessage(ConnectionInterface $from, $message)
    {

        // TODO - pull this out into helper and setup tests.
        $c = $this->clients;
        $player = new Say($c);
        $msg =  json_decode( $message );
        if( $this->roundInProgress && $c->contains($from) && $c[$from]->token == $msg->token  ){
            echo $message.PHP_EOL;
            $this->clients->attach( $from, $msg );
        } elseif ( $this->tiebreakerInProgress && $c->contains($from) && $c[$from]->token == $msg->token ){
            $player = $this->say->to( $this->clients );
            echo $message.PHP_EOL;
            $this->clients->attach( $from, $msg );
            $player->say($from, Say::TIEBREAKER_ANSWERED );
        }else{
            $player->sayError( $from, Say::ROUND_NOT_STARTED );
        }



    }

    /**
     * This is called before or after a socket is closed (depends on how it's closed).  SendMessage to $conn will not result in an error if it has already been closed.
     * @param  ConnectionInterface $conn The socket/connection that is closing/closed
     * @throws \Exception
     */
    function onClose(ConnectionInterface $conn)
    {
        // If this is called and a user is still in the clients list - they may try and reconnect.
        // So, store this connection and its attached info in a disconnected user array. Then I can
        // check against this array to allow users to reconnect to the current game if they are allowed.
       
        $info = $this->clients->offsetGet($conn);
        $this->disconnected->attach($conn, $info);

    	$this->clients->detach($conn);
    }

    /**
     * If there is an error with one of the sockets, or somewhere in the application where an Exception is thrown,
     * the Exception is sent back down the stack, handled by the Server and bubbled back up the application through this method
     * @param  ConnectionInterface $conn
     * @param  \Exception          $e
     * @throws \Exception
     */
    function onError(ConnectionInterface $conn, \Exception $e)
    {

    }

    public function numberOfClients()
    {
        return $this->clients->count();
    }

    /**
     * Close a connection to a client.
     */
    public function closeConnection(ConnectionInterface $conn)
    {
        $conn->close();
    }


    /**
     * Broadcast a message to all the clients from the SplObjectStorage object.
     */
    public function broadcastMessage( $msg, $clients=null )
    {
        if(!$clients){
            $clients = $this->clients; 
        }
        $clients->rewind();
        while($clients->valid()) {
            $info = $clients->getInfo();
            $clients->current()->send($msg);
            $clients->next();
        }
    }

    /**
     * Broadcast a message to all the clients from the SplObjectStorage object.
     */
    public function broadcastInfoMessage()
    {
        $this->clients->rewind();
        while($this->clients->valid()) {
            $this->clients->getInfo()->answer;
            $this->clients->current()->send( json_encode( $this->clients->getInfo()->answer ) );
            $this->clients->next();
        }
    }
    
    public function timeToNextGame()
    {
        return "180";
    }

    /**
     * Sets the value of gameStarted.
     *
     * @param mixed $gameStarted the game started
     *
     * @return self
     */
    public function setGameStarted( $gameStarted )
    {
        $this->gameStarted = $gameStarted;
        return $this;
    }



    /**
     * Gets the value of roundInProgress.
     *
     * @return mixed
     */
    public function isRoundInProgress()
    {
        return $this->roundInProgress;
    }


    public function disconnectClients($clients=null)
    {
        $clients->rewind();
        while( $clients->valid() ) {
            $conn = $clients->current();
            $conn->close();
            $clients->next();
        }
    }

    public function weHaveAWinner()
    {
        
    }

    public function resetClients($clients=null)
    {
        $c = $clients ? $clients : $this->clients;
        $c->rewind();
        while( $c->valid() ) {
            $c->getInfo()->answer = null;
            $c->next();
        }
    }

    public function getConnAnswer($conn, $clients=null)
    {
        $c = $clients ? $clients : $this->clients;
        return $clients[$conn]->answer;
    }


}
