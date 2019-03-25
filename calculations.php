<?php
	public class Calculations {
		
		public constant $ATTACK_HIGH = 3;
		public constant $ATTACK_MEDIUM = 1.5;
		public constant $ATTACK_LOW = 1;
		public constant $DEFENSE_HIGH = 3;
		public constant $DEFENSE_MEDIUM = 1.5
		public constant $DEFENSE_LOW = 1;
		public constant $HITPOINTS = 10;
		
		public constant $ISLANDS_DISTANCE_WATER_SECONDS = 720;
		
		public constant $DIFFICULTY = 1;
		
		private $islandOcean1;
		private $islandOcean2;
		private $islandId1;
		private $islandId2;
		private $islandCoords1;
		private $islandCoords2;
		
		private $amountSKoff;
		private $amountBSoff;
		private $amountSPoff;
		private $amountSKdef;
		private $amountBSdef;
		private $amountSPdef;
		private $offBonus;
		private $defBonus;
		
		private $amountIslandsOff;
		private $amountIslandsDef;
		
		public function __construct(){
			
		};
		
		public function shippingDuration(object $islandStart, object $islandDest) {
			$startID = $islandStart->getID();
			$destID = $islandDest->getID();
			
			$durationSec = islandDistanceByID($startID, $destID) * $ISLANDS_DISTANCE_WATER_SECONDS;
			$durationTime = new DateTime('');
			$durationTime -> setTime(0, 0, $durationSec);
			$durationTime -> format(H:i:s);
		}
		
		public function island_CoordsToID (String $islandCoords) {
			$parts = preg_split(':', $islandCoords);
			$oz = $parts[0];
			$ig = $parts[1];
			$in = $parts[2];
			
			$isl_Id_x = $ig%10 + $in%5;
			$isl_Id_y = $ig/10 + $in/5;
			
			$isl_ID = $isl_Id_x*25 + $isl_Id_y;
			$isl_ID_w_OZ = $oz * 10000 + $isl_ID;
			
			return $isl_ID_w_OZ;
		}
		
		public function island_IdToCoords(int $isl_Id) {
			$isl_Coords = "";
			
			$oz = $isl_Id/10000;
			
			$ig_dx = ($isl_Id%50)/5;
			$ig_dy = ($isl_Id%10000)/250;
			
			$isl_dx = $isl_Id%5;
			$isl_dy = (($isl_Id%10000)/50)%5;
			
			if($oz < 10) {
				$oz = "0" . $oz
			}
			
			$isl_Coords = $oz . ":" . $ig_dy . $ig_dx . ":" . $isl_dy . $isl_dx;
			
			return $isl_Coords;
		}
		
		
		
		private function islandDistanceByCoords (String $islCoordsStart, String $islCoordsDest) {
			$isl_ID_Start = island_CoordsToID($islCoordsStart);
			$isl_ID_Dest = island_CoordsToID($islCoordsDest);
			
			$distance = islandDistanceByID($isl_ID_Start, $isl_ID_Dest);
		}
		
		private function islandDistanceByID (int $isleID1, int $isleID2) {
			$oz1 = $isleID1/10000;
			$oz2 = $isleID2/10000;
			
			$id1 = $isleID1%10000;
			$id2 = $isleID2%10000;
			
			$dx = 0;
			$dy = 0;
			
			//horizontal part
			if($oz1%10 != $oz2%10) {
				$dx = 50 - abs($id1%50 - $id2%50);
			} else {
				$dx = $id1%50 - $id2%50;
			}
			
			//vertical part
			if($oz1/10 != $oz2/10) {
				$dy = 50 - abs($id1/50 - $id2/50);
			} else {
				$dy = $id1/50 - $id2/50;
			}
			
			//total distance via Pythagoras
			$distance = ($dx^2 + $dy^2)^0.5;
			
			return $distance;
		}
		
		private function attackValue (object $fleet) {
			$amountSKatt = $fleet->getAmountSK();
			$amountBSatt = $fleet->getAmountBS();
			$amountSPatt = $fleet->getAmountSP();
			
			$attBonus = $fleet->getBonusAtt();
			
			$attTotal = ($amountSKatt * $ATTACK_LOW + $amountSPatt * $ATTACK_MEDIUM + $amountBSatt * $ATTACK_HIGH) * (1.0 + $attBonus/100);
			
			return $attTotal;
		}
		
		private function defenseValue (object $island) {
			$amountSKdef = $island->getAmountSK();
			$amountBSdef = $island->getAmountBS();
			$amountSPdef = $island->getAmountSP();
			
			$defTotal = $amountSKdef * $DEFENSE_HIGH + $amountSPdef * $DEFENSE_MEDIUM + $amountBSdef * $DEFENSE_LOW;
			
			return $defTotal;
		}
		
		//newbie protection: 1 - [(islands att)-(islands def)]/(islands att)
		public function newbieProtection (int $islAmountAtt, int $islAmountDef) {
			$attFactor = 1;
			if(($islAmountAtt * 0.75 * $DIFFICULTY) > $islAmountDef) {
				$attFactor = 1 - ($islAmountAtt * $DIFFICULTY - $islAmountDef)/($islAmountAtt * $DIFFICULTY);
			}
			
			return $attFactor;
		}
		
		/**
		 *
		 *	Need to build functions	getTroopAmount(object $object) returns int[] troops;
		 *									troops[0] -> SK
		 *									troops[1] -> BS
		 *									troops[2] -> SP
		 *						and	setTroopAmount(int[] troops)
		 *
		 */
		public function battleScript (object $fleet, object $island) {
			$attackValue = attackValue($fleet);
			$defenseValue = defenseValue($island);
			
			$troopsAtt = getTroopAmount($fleet);
			$troopsDef = getTroopAmount($island);
			
			$hpAtt = $HITPOINTS * getTroopAmount($fleet);
			$hpDef = $HITPOINTS * getTroopAmount($island) * (1.0 + $island->getDefBonus() / 100 );
		}
		
	}

?>
