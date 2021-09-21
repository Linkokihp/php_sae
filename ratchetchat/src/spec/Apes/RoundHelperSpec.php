<?php

namespace spec\Apes;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Underscore\Types\Object;
use Ratchet\ConnectionInterface;

class RoundHelperSpec extends ObjectBehavior
{

  // should accept n answers arrays return lowest count
  // should filter storage object by there length
  // should be able to combine x num of spl objects togeather
  // should return a new storage object with the combined lowest storage objects
  // should attach custom data to my spl
  
    function let(\SplObjectStorage $answerA,\SplObjectStorage $answerB,\SplObjectStorage $answerC ){

        $this->shouldHaveType('Apes\RoundHelper');  
    }

    // should accept n answers arrays return lowest count 
    function it_should_accept_n_answers_arrays_return_lowest_count_thats_not_0( $answerA, $answerB, $answerC ){
    	$answerA->count()->willReturn(0);
    	$answerB->count()->willReturn(4); 
    	$answerC->count()->willReturn(6);
    	$this->minCount( $answerC, $answerB, $answerA )->shouldReturn(4);
    }


    // should filter storage object by there length
    function it_should_filter_storage_object_by_there_length( $answerA, $answerB, $answerC ){
    	$answerA->count()->willReturn(5);
    	$answerB->count()->willReturn(4); 
    	$answerC->count()->willReturn(6);
		$this->filterSplByMin($answerC, $answerB, $answerA)->shouldReturn([$answerB]);

        $answerA->count()->willReturn(5);
        $answerB->count()->willReturn(5); 
        $answerC->count()->willReturn(6);
        $this->filterSplByMin($answerC, $answerB, $answerA)->shouldReturn([$answerB,$answerA]);
    }

    // should be able to combine x num of spl objects togeather
    function it_should_be_able_to_combine_x_num_of_spl_objects_togeather(){

    	$o1 = new \StdClass;
    	$o2 = new \StdClass;
    	$o3 = new \StdClass;
    	$o4 = new \StdClass;
    	$o5 = new \StdClass;
    	$o6 = new \StdClass;

    	$splA = new \SplObjectStorage;
    	$splA->attach($o1);
    	$splA->attach($o2);
    	$splA->attach($o3);

    	$splB = new \SplObjectStorage;
    	$splB->attach($o4);
    	$splB->attach($o5);
    	$splB->attach($o6);

    	$this->combineSpl($splA,$splB)->shouldHaveType('\SplObjectStorage');
    	$this->combineSpl($splA,$splB)->shouldHaveCount(6);
    	$this->combineSpl($splA,$splA,$splB)->shouldHaveCount(6);
    }


    // should attach custom data to my spl
    function it_should_attach_custom_data_to_my_spl(){

    	$o1 = new \StdClass;
    	Object::set($o1, 'name', 'Alan');

    	$o2 = new \StdClass;
    	Object::set($o2, 'name', 'John');
    	
    	$o3 = new \StdClass;
		Object::set($o3, 'name', 'Ringo');

    	$spl = new \SplObjectStorage;
    	
    	$spl->attach($o1, "I am DATA 1");
    	$spl->attach($o2, "I am DATA 2");
    	$spl->attach($o3, "I am DATA 3");    

  		foreach ($spl as $value) {
  			$spl->getInfo();
  		}

    }

    function it_should_return_a_new_storage_object_based_on_the_answer(){

        $answer1 = json_decode( '{"answer":1,"token":"token-goes-here"}' );
        $answer2 = json_decode( '{"answer":2,"token":"token-goes-here"}' );
        $answer3 = json_decode( '{"answer":3,"token":"token-goes-here"}' );
        $answer4 = json_decode( '{"not":null}' );

        $clients = new \SplObjectStorage;

        $conn1= new \StdClass();
        $conn2= new \StdClass();
        $conn3= new \StdClass();
        $conn4= new \StdClass();
        $conn5= new \StdClass();
        $conn6= new \StdClass();
        $conn7= new \StdClass();

        $clients->attach($conn1, $answer1);
        $clients->attach($conn2, $answer1);
        $clients->attach($conn3, $answer1);
        $clients->attach($conn4, $answer1);
        $clients->attach($conn5, $answer2);
        $clients->attach($conn6, $answer3);
        $clients->attach($conn7, $answer4);  


        // test counting
        $a = $this->generateAnswerObject(1, $clients)->shouldHaveCount( 4 );
        $b = $this->generateAnswerObject(2, $clients)->shouldHaveCount( 1 );
        $c = $this->generateAnswerObject(3, $clients)->shouldHaveCount( 1 );
        $this->generateAnswerObject(4, $clients)->shouldHaveCount( 0 );
        $this->generateAnswerObject("nothing", $clients)->shouldHaveCount( 0 );


        // test type
        $this->generateAnswerObject(1, $clients)->shouldHaveType('\SplObjectStorage');


        // test pull data back out.
        $s = $this->generateAnswerObject(1, $clients);
        $s->shouldHaveCount(4);
        $s->getInfo()->shouldReturn($answer1);
        $s->current()->shouldReturn($conn1);


        // test min count again
        $this->minCount($a, $b, $c)->shouldReturn(1);
    }

}
