<?php

	/**
	* 
	*/
	class ClassName extends AnotherClass
	{
		
		function __construct(argument)
		{

		}

		function startRound(){
			$timer->start();
		}

		$timer->on('START_ROUND', function(){
			collectData();
		});

		$timer->on('ROUND_END', function(){
			processData();

			if(oneWinner){
				emit('WINNER');
			}else(
				emit('START_ROUND');
				startRound();
			)
		});


	}