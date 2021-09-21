<?php

namespace spec\Apes;

class Clients
{

	public static function create( $type,  $conn1, $conn2, $conn3, $conn4, $conn5, $conn6, $conn7){

		  $answer1 = json_decode( '{"answer":1,"token":"token-goes-here"}' );
    	$answer2 = json_decode( '{"answer":2,"token":"token-goes-here"}' );
    	$answer3 = json_decode( '{"answer":3,"token":"token-goes-here"}' );
	    $clients = new \SplObjectStorage;

			if ( $type === "one-winner"){
	      // attach the dummys
	    	$clients->attach($conn1, $answer1);
	    	$clients->attach($conn2, $answer1);
	    	$clients->attach($conn3, $answer1);
	    	$clients->attach($conn4, $answer1);
	    	$clients->attach($conn5, $answer2);
	    	$clients->attach($conn6, $answer3);
	    	$clients->attach($conn7, $answer3);
	    	return $clients;
			}
			else if ( $type === "four-winner")
			{
	      // attach the dummys
	    	$clients->attach($conn1, $answer1);
	    	$clients->attach($conn2, $answer1);
	    	$clients->attach($conn3, $answer1);
	    	$clients->attach($conn4, $answer2);
	    	$clients->attach($conn5, $answer2);
	    	$clients->attach($conn6, $answer3);
	    	$clients->attach($conn7, $answer3);
	    	return $clients;
			}


	}

}