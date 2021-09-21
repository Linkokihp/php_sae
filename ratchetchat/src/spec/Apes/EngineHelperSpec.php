<?php

namespace spec\Apes;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EngineHelperSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Apes\EngineHelper');
    }


    function it_should_return_a_data_object(){
        $data = new \stdClass;
        $data->answer = null;
        $data->token = "939393939";  
    	$this->getDataObject( null, "939393939")->shouldBeLike( $data );
    }

    function it_should_compare_the_token_with_those_in_the_disconnected_array(){

        $data1 = new \stdClass;
        $data1->answer = null;
        $data1->token = "939393939";  

        $disconnected = new \SplObjectStorage;
        $conn1 = new \stdClass;
        $conn2 = new \stdClass;
        $disconnected->attach($conn1, $data1);
        
        $token = '123456789';
        $this->checkIfDisconnected($token, $disconnected)->shouldReturn(false);

        $data2 = new \stdClass;
        $data2->answer = null;
        $data2->token = $token;
        $disconnected->attach($conn2, $data2);
        $this->checkIfDisconnected($token, $disconnected)->shouldReturn(true);
        // if run again - the conn should have been removed.
        $this->checkIfDisconnected($token, $disconnected)->shouldReturn(false);

    }
}
