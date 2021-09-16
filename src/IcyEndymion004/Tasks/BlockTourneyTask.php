<?php

namespace IcyEndymion004\Tasks;

use pocketmine\item\Item;
use pocketmine\scheduler\Task;
use pocketmine\utils\TextFormat;
use IcyEndymion004\Loader;

class BlockTourneyTask extends Task{

	public function __construct(Loader $plugin){
		$this->plugin = $plugin;
	}

	public function onRun($currentTick): bool{
		$econ = $this->plugin->getServer()->getPluginManager()->getPlugin("EconomyAPI")->getInstance();
		if($this->plugin->blockTourney() == true){
			$timestamp = $this->plugin->btSetup["timestamp"];
			$elapsedpre = $timestamp + $this->plugin->btSetup["time"];
			$elapsed = $elapsedpre - time();
			foreach($this->plugin->getServer()->getOnlinePlayers() as $p){
				if($this->plugin->btSetup["prizetype"] == "items"){
					if(isset($this->plugin->bT[$p->getName()])){
						$p->sendPopup(TextFormat::AQUA . "Your blocks mined: " . TextFormat::GOLD . $this->plugin->bT[$p->getName()] . TextFormat::WHITE . " - " . TextFormat::AQUA . "Most blocks mined: " . TextFormat::GOLD . $one . "(" . max($this->plugin->bT) . ")" . TextFormat::WHITE . "\n" . TextFormat::AQUA . "Time left: " . TextFormat::GOLD . $elapsed . " seconds" . TextFormat::WHITE . " - " . TextFormat::AQUA . "Prize: " . TextFormat::GOLD . $this->plugin->btSetup["prizecount"] . " " . Item::fromString($this->plugin->btSetup["prizeid"])->getName() . "/s ");
					}else{
						$p->sendPopup(TextFormat::AQUA . "Your blocks mined: " . TextFormat::GOLD . "0" . TextFormat::WHITE . " - " . TextFormat::AQUA . "Most blocks mined: " . TextFormat::GOLD . $one . "(" . max($this->plugin->bT) . ")" . TextFormat::WHITE . "\n" . TextFormat::AQUA . "Time left: " . TextFormat::GOLD . $elapsed . " seconds" . TextFormat::WHITE . " - " . TextFormat::AQUA . "Prize: " . TextFormat::GOLD . $this->plugin->btSetup["prizecount"] . " " . Item::fromString($this->plugin->btSetup["prizeid"])->getName() . "/s ");
					}
				}elseif($this->plugin->btSetup["prizetype"] == "cash"){
					if(isset($this->plugin->bT[$p->getName()])){
						$p->sendPopup(TextFormat::AQUA . "Your blocks mined: " . TextFormat::GOLD . $this->plugin->bT[$p->getName()] . TextFormat::WHITE . "\n" . TextFormat::AQUA. "Time left: " . TextFormat::GOLD . $elapsed . " seconds" );
					}else{
						$p->sendPopup(TextFormat::AQUA . "Your blocks mined: " . TextFormat::GOLD . "0" . TextFormat::WHITE . " - " . TextFormat::WHITE . "\n" . TextFormat::AQUA . "Time left: " . TextFormat::GOLD . $elapsed . " seconds" );
					}
				}
			}
			if(time() - $this->plugin->btSetup["timestamp"] >= $this->plugin->btSetup["time"]){
				$btblocks = array_keys($this->plugin->bT);
				//list($btblocks) = 
                asort($btblocks);
                foreach ($btblocks as $key => $val ){
				$codedval = json_encode($val);
				$name = json_decode($codedval);
				$codedkey = json_encode($key);
				$place = json_decode($codedkey);
				$placement = ($place + 1);
				//sort($btblocks);
			
				/*
                echo ($key[0] . "=" . $val[0] . "\n");
				echo ($key[1] . "=" . $val[1] . "\n");
				echo ($key[2] . "=" . $val[2] . "\n");
				echo ($key[3] . "=" . $val[3] . "\n");
				echo ($key[4] . "=" . $val[4] . "\n");
				*/
				//echo ($btblocks[0]);
                
				foreach($this->plugin->getServer()->getOnlinePlayers() as $p){

					if(isset($name[0])){
					$p->sendMessage($name[0] . "Has Place In " . $placement[0] . " Place\n");
					$econ->addMoney($name[0], $this->plugin->btSetup["1stPlaceReward"]);
                    break; 
					}else{
					echo ("No 1st Place");
					}
					if(isset($name[1])){
					echo ("No 2nd Place");
					$p->sendMessage($name[1] . "Has Place In " . ($key[1] + 1) . " Place\n");
					$econ->addMoney($name[1], $this->plugin->btSetup["2ndPlaceReward"]);
					break; 
					}else{
					echo ("No 2nd Place");
					}
					if(isset($name[2])){
					$p->sendMessage($name[2] . "Has Place In " . ($key[2] + 1) . " Place\n");
                    $econ->addMoney($name[2], $this->plugin->btSetup["3rdPlaceReward"]);
					echo ("No 3rd Place");
					break;
					}else{
					echo ("No 3rd Place");
					}
					if(isset($name[3])){
					$p->sendMessage($name[3] . "Has Place In " . ($key[3] + 1) . " Place\n");
					$econ->addMoney($name[3], $this->plugin->btSetup["4thPlaceReward"]);
					break;
					}else{
					echo ("No 4th Place");
				    }
					if(isset($name[4])){
					$p->sendMessage($name[4] . "Has Place In " . ($key[4] + 1) . " Place\n");
					$econ->addMoney($name[4], $this->plugin->btSetup["5thPlaceReward"]);
					break; 
					}else{
					echo ("No 5th Place");
					}
                
				}
				
				if($this->plugin->btSetup["prizetype"] == "cash"){
				/*
				$econ->addMoney($btblocks[0], $this->plugin->btSetup["1stPlaceReward"]);
				$econ->addMoney($btblocks[1], $this->plugin->btSetup["2ndPlaceReward"]);
				$econ->addMoney($btblocks[2], $this->plugin->btSetup["3rdPlaceReward"]);
				$econ->addMoney($btblocks[3], $this->plugin->btSetup["4thPlaceReward"]);
				$econ->addMoney($btblocks[4], $this->plugin->btSetup["5thPlaceReward"]);
                */
				unset($this->plugin->btSetup);
				unset($this->plugin->bT);
				return true;
				}
			}
		}
		}
		return true;
	}
}