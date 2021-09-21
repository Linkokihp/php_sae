<?php

namespace spec\Apes;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Ratchet\ConnectionInterface;
use Apes\Say as Say;
class SaySpec extends ObjectBehavior
{
    function let( \SplObjectStorage $clients, ConnectionInterface $conn, ConnectionInterface $conn2, ConnectionInterface $conn3, ConnectionInterface $conn4, ConnectionInterface $conn5 )
    {	
    	$this->beConstructedWith( $clients );
        $this->shouldHaveType('Apes\Say');
    }

	function it_should_shoutout_to_all_users(  $conn, $conn2, $conn3 ){
    	
    	$client  = new \SplObjectStorage();
    	$this->clients = $client;

    	$this->clients->attach($conn, json_decode( '{"answer":1,"token":"10292919021903290"}' ) );
    	$this->clients->attach($conn2, json_decode( '{"answer":2,"token":"12312312314234234"}' ) );
    	$this->clients->attach($conn3, json_decode( '{"answer":3,"token":"123123123123123122"}' ) );
    	
    	$conn->send('{"message":"YOU_HAVE_LOST","token":"10292919021903290","data":null}')->shouldBeCalled();
    	$conn2->send('{"message":"YOU_HAVE_LOST","token":"12312312314234234","data":null}')->shouldBeCalled();
    	$conn3->send('{"message":"YOU_HAVE_LOST","token":"123123123123123122","data":null}')->shouldBeCalled();

    	$this->shout( Say::YOU_HAVE_LOST );
    }

    function it_should_allow_you_to_set_the_clients_object_at_run_time( \SplObjectStorage $listeners){
        $this->to($listeners)->shouldReturn($this);
        $this->clients->shouldBe($listeners);
        $this->to($listeners)->shout("hello");
    }

    function it_should_accept_data_object_for_shout(){
        $this->shout( "foo", ['foo'=>'bar'] );
    }

    function it_should_have_a_that_function_figures_out_if_you_want_to_shout_or_say($conn){
        $this->clients = new \SplObjectStorage;
        $this->clients->attach($conn, json_decode( '{"answer":1,"token":"10292919021903290"}' ) );
        $this->that("foo", ['foo'=>'bar'])->shouldReturn('shouting');
        $this->that( $conn, "foo", ['foo'=>'bar'])->shouldReturn('saying');
    }

	function it_should_say_to_single_clients($conn){
    	$this->clients = new \SplObjectStorage();
    	$this->clients->attach($conn, json_decode( '{"answer":1,"token":"10292919021903290"}' ) );
    	$this->say($conn, Say::YOU_HAVE_LOST	)->shouldReturn( '{"message":"YOU_HAVE_LOST","token":"10292919021903290","data":null}');
    	$this->say($conn, Say::DISCONNECTING 	)->shouldReturn( '{"message":"DISCONNECTING","token":"10292919021903290","data":null}');
        $this->say($conn, Say::TIEBREAKER_START )->shouldReturn( '{"message":"TIEBREAKER_START","token":"10292919021903290","data":null}');
        $this->say($conn, Say::TIEBREAKER_END   )->shouldReturn( '{"message":"TIEBREAKER_END","token":"10292919021903290","data":null}');
        $this->say($conn, Say::ROUND_START      )->shouldReturn( '{"message":"ROUND_START","token":"10292919021903290","data":null}');
        $this->say($conn, Say::ROUND_END        )->shouldReturn( '{"message":"ROUND_END","token":"10292919021903290","data":null}');
        $this->say($conn, Say::YOU_HAVE_WON     )->shouldReturn( '{"message":"YOU_HAVE_WON","token":"10292919021903290","data":null}');
    }

    function it_should_send_the_number_of_players_with_game_starting($conn){
        $this->clients = new \SplObjectStorage();
        $this->clients->attach($conn, json_decode( '{"answer":1,"token":"10292919021903290"}' ) );        
    	$this->say($conn, Say::GAME_STARTING , ["players"=>$this->clients->count() ])->shouldReturn( '{"message":"GAME_STARTING","token":"10292919021903290","data":{"players":1}}');
    }

    function it_should_allow_you_to_attach_an_array_data($conn){
        $this->clients = new \SplObjectStorage();
        $this->clients->attach($conn, json_decode( '{"answer":1,"token":"10292919021903290"}' ) );    
        $this->say($conn, Say::YOU_HAVE_LOST, ["countdown" => 300 ]  )->shouldReturn( '{"message":"YOU_HAVE_LOST","token":"10292919021903290","data":{"countdown":300}}');
    }

    function it_should_encode_data_in_the_correct_format( ConnectionInterface $c ){
    	$this->clients = new \SplObjectStorage();
    	$this->clients->attach($c, json_decode( '{"answer":1,"token":"10292919021903290"}' ) );
    	$this->encode( $c, Say::YOU_HAVE_LOST )->shouldNotReturn(false);
    	$this->encode( $c, Say::YOU_HAVE_LOST )->shouldReturn('{"message":"YOU_HAVE_LOST","token":"10292919021903290","data":null}');
    }

    function it_should_send_readable_json_error_messages_to_users(){
    	$this->jsonError(Say::NO_TOKEN)->shouldReturn('{"message":"NO_TOKEN"}');
    }

    function it_should_still_send_message_to_client_if_they_dont_exist_in_clients(ConnectionInterface $conn  ){
    	$this->sayError( $conn, Say::GAME_IN_PROGRESS )->shouldReturn( '{"message":"GAME_IN_PROGRESS"}');
    }



}
