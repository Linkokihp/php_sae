<?php

namespace Apes;

class EngineHelper
{
	// Untestable - unless I mock up the entire object somehow.
    public function getDataKey( $conn, $key ){
        $qs = $conn->WebSocket->request->getQuery();
        return $qs->get( $key );
    }

    public function getDataObject( $answer, $token ){
        $data = new \stdClass;
        $data->answer = $answer;
        $data->token = $token;
        return $data;
    }

    public function checkIfDisconnected($token, $disconnected){
        $tokenExists = false;   
        $disconnected->rewind();
        while($disconnected->valid()) {
            $info = $disconnected->getInfo();
            if( $info->token === $token ){
                $tokenExists = true;
                $disconnected->detach($disconnected->current());
            }  
            $disconnected->next();
        }
        return $tokenExists;
    }

}
