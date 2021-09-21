<?php


namespace spec\Apes;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use React\EventLoop\LoopInterface;
use Evenement\EventEmitter;
use Apes\QuestionResolver;
use Apes\RoundProcessor;
use Apes\EngineHelper;
use Guzzle\Http\Message\EntityEnclosingRequest;
use Guzzle\Http\QueryString;
use Apes\Say;

require 'Clients.php';

class GameEngineSpec extends ObjectBehavior
{
    function let( Say $say, LoopInterface $loop, EventEmitter $emit, \SplObjectStorage $clients,  ConnectionInterface $connA, ConnectionInterface $connB, RoundProcessor $roundProcessor,  EngineHelper $helper )
    {
        $time = 60;
        $this->beConstructedWith( $loop, $emit, $clients, $roundProcessor, $helper, $time );
    	$this->shouldBeAnInstanceOf('Ratchet\MessageComponentInterface');
        $this->shouldHaveType('Apes\GameEngine');
    }

    // function it_should_attach_new_clients_onOpen(ConnectionInterface $conn, $clients, $helper, EntityEnclosingRequest $WebSocket, QueryString $queryString){
    //  //    $helper->getDataKey($conn, 'token')->willReturn('token_value');
    //  //    $data = new \stdClass;
    //  //    $data->answer = null;
    //  //    $data->token = 'token_value';
    //  //    $helper->getDataObject( null,'token_value' )->willReturn($data);
    //  //    $clients->attach($conn, $data)->shouldBeCalled();
    //  //    $clients->serialize()->shouldBeCalled();
    //  //    $data = new \stdClass;
    //  //    $data->answer = null;
    //  //    $data->token = 'token_value';
    //  //    $clients->attach($conn, $data)->shouldBeCalled();
    // 	// $this->onOpen($conn);
    // }

    function it_should_reset_clients_at_the_start_of_a_round_setting_answer_to_null(){
        $answer1 = json_decode( '{"answer":1,"token":"token-goes-here"}' );
        $clients = new \SplObjectStorage;
        $conn1= new \StdClass();
        $clients->attach($conn1, $answer1);
        $this->getConnAnswer($conn1,$clients )->shouldReturn( 1 );
        $this->resetClients($clients);
        $this->getConnAnswer($conn1,$clients )->shouldReturn( null );

    }

    // function it_should_handle_a_client_closing_a_connection(ConnectionInterface $conn,$clients, $helper)
    // {
    //  //    $helper->getDataKey($conn, 'token')->willReturn('token_value');
    //  //    $helper->getDataObject(null,'token_value')->willReturn($data);
     
    //  //    $data = new \stdClass;
    //  //    $data->answer = null;
    //  //    $data->token = 'token_value';

    //  //    $clients->contains($conn)->shouldBeCalled();      
    //  //    $clients->attach($conn, $data)->shouldBeCalled();
    //  //    $clients->detach($conn)->shouldBeCalled();

    // 	// $this->onOpen($conn);
    // 	// $this->onClose($conn);
    // }

    function it_should_stop_accepting_clients_when_game_starts(ConnectionInterface $conn, $clients){
        $clients->attach($conn)->shouldNotBeCalled();
        $this->setGameStarted(true);
        $conn->send('{"message":"GAME_IN_PROGRESS"}')->shouldBeCalled();
        $conn->close()->shouldBeCalled();
        $this->onOpen($conn);
    }    

    function it_should_be_able_to_close_a_connection(ConnectionInterface $conn){
    	$conn->close()->shouldBeCalled();
    	$this->closeConnection($conn);
    }

    function it_should_broadcast_messages_to_all_clients(ConnectionInterface $conn1, ConnectionInterface $conn2, $clients){
    	$clients->attach($conn1); // add a connection
    	$clients->attach($conn2); // add a connection
    	$msg = "message goes here";
    	//$conn1->send($msg)->shouldBeCalled();
    	//$conn2->send($msg)->shouldBeCalled();
    	$this->broadcastMessage($msg);
    }

    function it_should_broadcast_attached_info_to_each_clients(ConnectionInterface $conn1, $clients){

        $this->onOpen($conn1);
        $clients->rewind()->shouldBeCalled();
        $clients->valid()->shouldBeCalled();
        // $clients->current()->shouldBeCalled();
        // $clients->getinfo()->shouldBeCalled();
        // $clients->next()->shouldBeCalled();
        $this->broadcastInfoMessage();
    }

    function it_should_inform_the_client_when_the_next_game_will_start( ConnectionInterface $conn ){
    	// This is a dummy time. Maybe I need a countDown class here?
        //$conn->WebSocket->willReturn('bla');
    	$this->onOpen($conn);
    }

    function it_should_start_a_round( $loop , $emit, $say, \SplObjectStorage $clients ){
        $this->say->to($clients);
        $clients->count()->willReturn(10);
        $clients->rewind()->shouldBeCalled();
        $clients->valid()->shouldBeCalled();
        $this->isRoundInProgress()->shouldReturn(false);
        $this->startRound();
        $this->isRoundInProgress()->shouldReturn(true);
    }


    function it_should_only_accept_messages_when_a_round_is_in_progress( ConnectionInterface $from ){
        $this->isRoundInProgress()->shouldReturn(false);
        $from->send('{"message":"ROUND_NOT_STARTED"}')->shouldBeCalled();
        $this->onMessage($from, "dummy message");
    }

    function it_should_tell_the_losers_they_have_lost(Say $say, $roundProcessor, ConnectionInterface $conn1,ConnectionInterface $conn2,ConnectionInterface $conn3,ConnectionInterface $conn4,ConnectionInterface $conn5,ConnectionInterface $conn6,ConnectionInterface $conn7){
        $this->clients = Clients::create("one-winner", $conn1, $conn2, $conn3, $conn4, $conn5, $conn6, $conn7);
        $roundProcessor->process($this->clients)->willReturn($this->clients);
        
        $this->calculateRound();
    }


    function it_should_kick_the_losers(  $clients  ){
        $this->disconnectClients($clients);
    }


    function it_should_create_a_tiebreaker_round(){
        $this->startTieBreaker();
    }

    function it_should_have_a_winner(){
        $this->weHaveAWinner();
    }

    // function it_should_dispatch_a_once_per_second_only_if_a_new_client_is_added_during_that_time($say){
    //     $this->say->shout(Argument::any())->shouldBeCalled();
    // }


}


