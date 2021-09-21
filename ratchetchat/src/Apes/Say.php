<?php

namespace Apes;
use Ratchet\ConnectionInterface;

class Say
{
	// Messages
	const YOU_HAVE_LOST 			= "YOU_HAVE_LOST";
    const CONNECTED                 = "CONNECTED_TO_GAME";
	const DISCONNECTING 			= "DISCONNECTING";
    const RECONNECTING              = "RECONNECTING";
	const GAME_STARTING 			= "GAME_STARTING";
	const TIEBREAKER_START  		= "TIEBREAKER_START";
	const TIEBREAKER_END	 		= "TIEBREAKER_END";
    const TIEBREAKER_ANSWERED       = "TIEBREAKER_ANSWERED";
	const ROUND_START 				= "ROUND_START";
	const ROUND_END	 				= "ROUND_END";
	const CORRECT_ANSWER	 		= "CORRECT_ANSWER";
	const YOU_HAVE_WON	 			= "YOU_HAVE_WON";
    const TICK                      = "TICK";

	// Errors
	const NO_TOKEN					= "NO_TOKEN";
	const GAME_IN_PROGRESS			= "GAME_IN_PROGRESS";
	const ROUND_NOT_STARTED			= "ROUND_NOT_STARTED";

	public $clients;
	public $subset;

	public function __construct($clients) {
		$this->clients = $clients;
	}

    public function to($listeners)
    {   
        $this->clients = $listeners;
        return $this;
    }   

	/**
	 * Send message to many connections
	 * @param  string $msg
	 * @param  SplObjectStorage $subset A subset of the clients object.
	 */
    public function shout( $msg, $data=null )
    {
    	$c = $this->clients;
        $c->rewind();
        while( $c->valid() ) {
        	$conn = $c->current();
        	$this->say( $conn, $msg, $data );
            $c->next();
        }
    }

    public function that(){
        $args = func_get_args();
        if( $args[0] instanceof ConnectionInterface  ){
            if( isset( $args[2] ) ){
                $this->say($args[0], $args[1], $args[2]);
            }else{
                $this->say($args[0], $args[1]);
            }
            return "saying";
        }else{
            if( isset( $args[1] ) ){
                $this->shout($args[0], $args[1]);
            } else{
                $this->shout($args[0]);
            }
            return "shouting";
        }
    }

    /**
     * Say something to a single conn
     * @param  ConnectionInterface $conn
     * @param  String $msg  A json formatted string
     * @return String       A json formatted string
     */
    public function say( $conn, $msg, $data=null )
    {
    	$json = $this->encode( $conn, $msg, $data );
    	if( $json ){
            echo $json.PHP_EOL;
        	$conn->send($json);
        	return $json;
    	} else {
    		$this->sayError( self::NO_TOKEN );
    	}
	    throw new \InvalidArgumentException("Connection does not exist in clients storage object");

    }

    public function sayError( $conn, $msg ){
    	$error = $this->jsonError( $msg );
        echo $error.PHP_EOL;
    	$conn->send( $error );
    	return $error;
    }

    /**
     * encode a string into a correctly formatted json string
     * @param  ConnectionInterface $conn
     * @param  String $msg
     * @return String $msg  A json formatted string
     */
    public function encode( $conn, $msg, $data=null )
    {
    	$c = $this->clients;
    	if( $c->contains($conn)){
	    	$token = $c[$conn]->token;
	    	$json = ['message'=>$msg, 'token'=>$token, 'data'=>$data ];
            return json_encode( $json );

    	}
    	throw new \InvalidArgumentException("Connection does not exist in clients storage object");
    }

    public function jsonError( $msg ){
    	return json_encode( ['message' => $msg ] );
    }

}
