<?php

namespace Apes;
use React\EventLoop\LoopInterface;
use Evenement\EventEmitter;
use React\Promise\Deferred;
class RoundTimer extends EventEmitter
{
	protected $loop;
    protected $emitter;
    protected $countdown;
    /**
     * Gets the value of countdown.
     *
     * @return mixed
     */
    public function getCountdown()
    {
        return $this->countdown;
    }

    /**
     * Sets the value of countdown.
     *
     * @param mixed $countdown the countdown
     *
     * @return self
     */
    public function setCountdown($countdown)
    {
        $this->countdown = $countdown;
        return $this;
    }

    public function __construct( LoopInterface $loop , EventEmitter $emitter)
    {
        $this->loop = $loop;
        $this->emitter = $emitter;
        $this->countdown = 0;
    }

    public function startGameCountdown($callback)
    {
       $this->loop->addTimer(300, $callback);
    }

    /**
     * Start a countdown to a games start time.
     * @return [type] [description]
     */
    public function startCountDown( $countDownTime )
    {  
        $this->setCountdown( $countDownTime );
        $timer = null;
        $timer = $this->loop->addPeriodicTimer(1, function() use (&$timer) {
            $this->decrementCountDown($timer);
        });

    }


    public function decrementCountDown($timer)
    {
        if($this->countdown > 0){
            $this->countdown--;
            $this->emitter->emit( 'GAME.COUNTDOWN', array($this->countdown)  );
            return;
        } else {
            $timer->cancel();
            $this->emitter->emit( 'GAME.COUNTDOWN_END', array($this->countdown)  );
        }
    }

    // public function startRound($roundLength)
    // {
    //     $deferred = new Deferred();
    //     $this->loop->addTimer($roundLength, function() use ($deferred){
    //         $deferred->resolve();
    //     } );
    //     return $deferred->promise();
    // }

}
