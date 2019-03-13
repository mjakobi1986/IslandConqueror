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
		
		public function __construct(){};
		
		public function setIslandId1($isl_Id){
			$islandId1 = $isl_Id;
		}
		public function getIslandId1(){
			return $islandId1;
		}
		
		public function shippingDurationByIslandId($islandId1, $islandId2) {
			
		}
		
	}
?>
