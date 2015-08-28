<?php
	class GetallenReeksMaker{
		public function getReeks(){
			$reeks = array();
			for($i = 0; $i < 10; $i++){
				$reeks[$i] = rand(1,100);
			}
			for ($i = 0; $i < count($reeks); $i++) {		//Als de array volledig van groot naar klein gesorteerd is is het nodig de array array_length keer te doorlopen
			    for ($j = 0; $j < count($reeks)-1; $j++) {		//Array moet één keer minder dan de array lengte doorlopen worden,
			        if ($reeks[$j] > $reeks[$j+1]) {			//omdat $array[array_lengte] niet meer vergeleken kan/moet
			            $temp = $reeks[$j+1];					// worden met $array[array_lengte + 1] (daar staat namelijk niets in)
			            $reeks[$j+1] = $reeks[$j];
			            $reeks[$j] = $temp; 		//Bijv. $array[1] verwisselen van plaats met $array[2] als $array[1] groter dan $array[2]
			        }
			     }
		  	}
		  	//sort($reeks);		//Eenvoudige functie om arrays te sorteren

		  	//rsort($reeks);
		  	//$reeks = array_reverse($reeks);		//2 functies om van groot naar klein te sorteren
			return $reeks;
		}
	}