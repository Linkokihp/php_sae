<?php

namespace Apes;
use Underscore\Types\Arrays;

class RoundHelper
{
	/**
	 * return the count of the lowest countable object that is not equal to 0
	 * @return [type] [description]
	 */
    public function minCount()
    {
        $filtered = Arrays::filter( func_get_args(), function($value) {
            return $value->count() != 0; 
        });
    	return Arrays::min( $filtered, function( $value ){
            return $value->count();
    	});
    }

    /**
     * combine x number of splstorage objects
     * @return [type] [description]
     */
    public function combineSpl()
    {
    	$args = func_get_args();
    	$spl = $args[0];
    	foreach ($args as $s) {
    		$spl->addAll($s);
    	}
    	return $spl;
    }

    public function filterSplByMin()
    {	
    	$min = $this->call('minCount', func_get_args());
    	$result = [];
    	foreach ( func_get_args() as $spl) {
    		if($spl->count() == $min){
    			$result[] = $spl;
    		}
    	}
		return $result;
    }


    private function call($funcName, $args){
    	return call_user_func_array(array( $this, $funcName ), $args);
    }

    // TODO ----------------------------------------------------------
    // THIS IS COULD BE MORE EFFICENT - AS IT CURRENTLY LOOPS 3 TIMES. 
    // I SHOULD BE ABLE TO ONLY LOOP THIS ONCE
    // ---------------------------------------------------------------
    public function generateAnswerObject($answer, $clients)
    {
        $spl = new \SplObjectStorage;
        $clients->rewind();
        while( $clients->valid() ) {
            $info = $clients->getInfo();
            $current = $clients->current();

            // if there is an answer.
            if ( isset( $info->answer )){
                if( $info->answer == $answer ){
                   $spl->attach( $current , $info );
                }
            }
            $clients->next();
        }
        $spl->rewind();
        return $spl;
    }
}
