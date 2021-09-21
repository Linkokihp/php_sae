<?php

namespace Apes;

use Apes\RoundHelper;

class RoundProcessor
{
	protected $clients;

    /**
     * Take a list of clients with attached answers and return the losers.
     * @param  SplObjectStorage $clients A list of connected users and there current answers.
     * @return SplObjectStorage A list of users to kick from the game.
     */
    public function process($clients)
    {
        $helper = new RoundHelper();
        $losers = $this->getLosers($clients, $helper);
        return $losers;
    }

    /**
     * Calculate the losers and return an splStorageObject of them.
     * @param  splStprageObject $clients
     * @param  RoundHelper $helper  A helper class with utility functions.
     * @return SplStorageObject The losers.
     */
    private function getLosers($clients, $helper)
    {
        $losers = new \SplObjectStorage();
        $a1 = $helper->generateAnswerObject(1, $clients);
        $a2 = $helper->generateAnswerObject(2, $clients);
        $a3 = $helper->generateAnswerObject(3, $clients);
        $count = $helper->minCount($a1, $a2, $a3);
        foreach ([$a1,$a2,$a3] as $spl) {
            if ( $spl->count() !== $count ){
                $losers->addAll($spl);
            }
        }
        return $losers;
    }

    public function processTiebreaker($clients)
    {   
        $clients->rewind();
        $ans1 = $clients->getInfo();
        $conn1 = $clients->current();
        $clients->next();
        $ans2 = $clients->getInfo();
        $conn2 = $clients->current();

        if( $ans1 <= $ans2 ){
            return $conn2;
        } else {
            return $conn1;
        }
    }
}
