<?php

namespace spec\Apes;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Ratchet\ConnectionInterface;
use Apes\RoundHelper;

class RoundProcessorSpec extends ObjectBehavior
{

    function let(  )
    {
        $this->shouldHaveType('Apes\RoundProcessor');
    }

    function mock(){

    }

    function it_should_have_a_process_method_that_returns_a_list_of_losers(){

    	$answer1 = json_decode( '{"answer":1,"token":"token-goes-here"}' );
    	$answer2 = json_decode( '{"answer":2,"token":"token-goes-here"}' );
    	$answer3 = json_decode( '{"answer":3,"token":"token-goes-here"}' );

    	// create Dummy objects
    	$clients = new \SplObjectStorage;
        $conn1= new \StdClass();
        $conn2= new \StdClass();
        $conn3= new \StdClass();
        $conn4= new \StdClass();
        $conn5= new \StdClass();
        $conn6= new \StdClass();
        $conn7= new \StdClass();

        // attach the dummys
    	$clients->attach($conn1, $answer1);
    	$clients->attach($conn2, $answer1);
    	$clients->attach($conn3, $answer1);
    	$clients->attach($conn4, $answer1);
    	$clients->attach($conn5, $answer2);
    	$clients->attach($conn6, $answer3);
    	$clients->attach($conn7, $answer3);

    	$this->process($clients)->shouldHaveType('\SplObjectStorage');
    	$this->process($clients)->shouldHaveCount(6);

        $clients = new \SplObjectStorage;
        $clients->attach($conn1, $answer1);
        $clients->attach($conn2, $answer1);
        $clients->attach($conn3, $answer1);
        $this->process($clients)->shouldHaveCount(0);

        $clients = new \SplObjectStorage;
        $clients->attach($conn1, $answer1);
        $clients->attach($conn2, $answer2);
        $clients->attach($conn3, $answer2);
        $this->process($clients)->shouldHaveCount(2);
    }

    function it_should_process_the_tiebreaker_round_and_return_the_loser(){

        // less
        $answer1 = json_decode( '{"answer":0.019,"token":"token-goes-here"}' );
        $answer2 = json_decode( '{"answer":0.020,"token":"token-goes-here"}' );

        // more
        $answer3 = json_decode( '{"answer":0.021,"token":"token-goes-here"}' );
        $answer4 = json_decode( '{"answer":0.020,"token":"token-goes-here"}' );

        // equal
        $answer5 = json_decode( '{"answer":0.020,"token":"token-goes-here"}' );
        $answer6 = json_decode( '{"answer":0.020,"token":"token-goes-here"}' );

        // create Dummy objects
        $clients = new \SplObjectStorage;
        $conn1= new \StdClass();
        $conn2= new \StdClass();

        // less - answer1 wins
        $clients->attach($conn1, $answer1);
        $clients->attach($conn2, $answer2);
        $this->processTiebreaker($clients)->shouldReturn($conn2);

        // more - answer2 wins
        $clients->attach($conn1, $answer3);
        $clients->attach($conn2, $answer4);
        $this->processTiebreaker($clients)->shouldReturn($conn1);

        // equal - answer1 wins ( I know its cheating a little )
        $clients->attach($conn1, $answer5);
        $clients->attach($conn2, $answer6);
        $this->processTiebreaker($clients)->shouldReturn($conn2);

    }

}
