<?php

namespace spec\Apes;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use React\EventLoop\LoopInterface;
use Evenement\EventEmitter;
use React\EventLoop\Timer\TimerInterface;
use React\Promise\Deferred;
use React\Promise\Promise;

class RoundTimerSpec extends ObjectBehavior
{
    function let( LoopInterface $loop, EventEmitter $emitter )
    {
    	$this->beConstructedWith($loop, $emitter);
        $this->shouldHaveType('Apes\RoundTimer');
    }

    function it_should_have_be_able_to_start_a_timer( LoopInterface $loop ){
    	$callback = function(){};
    	$loop->addTimer( 300, $callback )->shouldBeCalled();
    	$this->startGameCountdown( $callback );
    }

    function it_should_have_a_ticker( LoopInterface $loop ){
        $that = $this; 
    	$loop->addPeriodicTimer( 1, Argument::any() )->shouldBeCalled();
        $this->startCountDown(10);
    }

    function it_should_decrement_down_each_interval( TimerInterface $timer, EventEmitter $emitter ){
        $this->setCountdown(10);
        $emitter->emit('GAME.COUNTDOWN', Argument::any())->shouldBeCalled();
        $this->decrementCountDown( $timer );
        $this->getCountdown()->shouldEqual(9);
    }

    /**
     * It should emit a game end event and cancel the ticker
     * @param  React\EventLoop\Timer\TimerInterface $timer
     * @param  Evenement\EventEmitter   $emitter
     */
    function it_should_emit_a_game_end_event_and_cancel_the_ticker( $timer, $emitter){
        $this->setCountdown(0);
        $emitter->emit('GAME.COUNTDOWN_END', Argument::any())->shouldBeCalled();
        $timer->cancel()->shouldBeCalled();
        $this->decrementCountDown($timer);
    }


}
