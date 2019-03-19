<?php
	public class Calculations {
		
		public constant $ATTACK_HIGH = 3;
		public constant $ATTACK_MEDIUM = 1.5;
		public constant $ATTACK_LOW = 1;
		public constant $DEFENSE_HIGH = 3;
		public constant $DEFENSE_MEDIUM = 1.5
		public constant $DEFENSE_LOW = 1;
		public constant $HITPOINTS = 10;
		
		public constant $ISLANDS_DISTANCE_WATER = 12;
		
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
		
		public function shippingDurationByIslandId($islandId1, $islandId2) {
			
		}
		
		public function island_CoordsToIDwoOz ($islandCoords) {
			$parts = preg_split(':', $islandCoords);
			$ig = $parts[1];
			$in = $parts[2];
			
			$isl_Id_x = $ig%10 + $in%5;
			$isl_Id_y = $ig/10 + $in/5;
			
			$isl_ID = $isl_Id_x*25 + $isl_Id_y;
			
			return $isl_ID;
		}
		
		public function island_CoordsToIDwithOz ($islandCoords) {
			$parts = preg_split(':', $islandCoords);
			$oz = $parts[0];
			$ig = $parts[1];
			$in = $parts[2];
			
			$isl_Id_x = $ig%10 + $in%5;
			$isl_Id_y = $ig/10 + $in/5;
			
			$isl_ID = $isl_Id_x*25 + $isl_Id_y;
			$isl_ID_OZ = new Array($oz, $isl_ID);
			
			return $isl_ID_OZ;
		}
		
		public function island_IdToCoords($isl_OZ, $isl_Id) {
			$isl_Coords = "";
			
			$oz_x = isl_OZ%10;
			$oz_y = isl_OZ/10;
			
			$ig_x = (isl_Id%50)/5;
			$ig_y = (isl_Id/50)/5;
			
			$isl_x = isl_Id%5;
			$isl_y = (isl_Id/50)%5;
			
			$isl_Coords = $oz_y . $oz_x . ":" . $ig_y . $ig_x . ":" . $isl_y . $isl_x;
			
			return $isl_Coords;
		}
		
	}
?>
