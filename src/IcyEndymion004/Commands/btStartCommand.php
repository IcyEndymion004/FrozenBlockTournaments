<?php

namespace IcyEndymion004\Commands;

use pocketmine\command\Command;
use pocketmine\command\CommandExecutor;
use pocketmine\command\CommandSender;
use pocketmine\item\Item;
use pocketmine\utils\TextFormat;
use IcyEndymion004\Loader;
use IcyEndymion004\libs\jojoe77777\FormAPI\Form;
use IcyEndymion004\libs\jojoe77777\FormAPI\CustomForm;

class btStartCommand implements CommandExecutor{

	public $plugin;

	public function __construct(Loader $plugin){
		$this->plugin = $plugin;
		$plugin->getCommand("btstart")->setExecutor($this);
	}

	public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : void{
		$smcmd = strtolower($cmd);
		$economy = $this->plugin->getServer()->getPluginManager()->getPlugin("EconomyAPI")->getInstance();
		$prefix = $this->getConfig()->get("prefix");
		switch($smcmd){
			case "btstart":
				if(!isset($args[1])){
					$sender->sendMessage("$prefix Usage: §a/btstart <time> <prize type> <1st Place Prize> <2nd Place Prize> <3rd Place Prize> <4th Place Prize> <5th Place Prize>", false);
					return true;
				}
						if(!is_numeric($args[0])){
							$sender->sendMessage("$prefix §c§oTournament time must be numeric!");
							return true;
						}
						if($args[0] > 120){
							$sender->sendMessage("$prefix §c§oTournaments can only be 120 minutes long!");
							return true;
						}
						if($args[0] < 1){
							$sender->sendMessage("$prefix §c§oTournaments must be at least 1 minutes long!");
							return true;
						}
						$time = ($args[0] * 60);

						$prizetype = $args[1];

                                $TopPlacementReward = (int) $args[2];
								if(!is_int($TopPlacementReward)){
									$sender->sendMessage("$prefix §c§oInvalid Cash amount! Cash must be be between $1-$10,000,000!");
								}elseif($TopPlacementReward < 1){
									$sender->sendMessage("$prefix §c§oInvalid Cash amount! Cash must be be more than $1!");
								}elseif($TopPlacementReward > 10000000){
									$sender->sendMessage("$prefix §c§oInvalid Cash amount! Cash must be be less than $10,000,000!");
								}	
								$SecondPlacementReward = (int) $args[3];
								if(!is_int($SecondPlacementReward)){
									$sender->sendMessage("$prefix §c§oInvalid Cash amount! Cash must be be between $1-$10,000,000!");
								}elseif($SecondPlacementReward < 1){
									$sender->sendMessage("$prefix §c§oInvalid Cash amount! Cash must be be more than $1!");
								}elseif($SecondPlacementReward > 10000000){
									$sender->sendMessage("$prefix §c§oInvalid Cash amount! Cash must be be less than $10,000,000!");
								}
								$ThridPlacementReward = (int) $args[4];
								if(!is_int($ThridPlacementReward)){
									$sender->sendMessage("$prefix §c§oInvalid Cash amount! Cash must be be between $1-$10,000,000!");
								}elseif($ThridPlacementReward < 1){
									$sender->sendMessage("$prefix §c§oInvalid Cash amount! Cash must be be less than $10,000,000!");
								}
								$ForthPlacementReward = (int) $args[5];
								if(!is_int($ForthPlacementReward)){
									$sender->sendMessage("$prefix §c§oInvalid Cash amount! Cash must be be between $1-$10,000,000!");
								}elseif($ForthPlacementReward < 1){
									$sender->sendMessage("$prefix §c§oInvalid Cash amount! Cash must be be more than $1!");
								}elseif($ForthPlacementReward > 10000000){
									$sender->sendMessage("$prefix §c§oInvalid Cash amount! Cash must be be less than $10,000,000!");
								}
						        $FifthtPlacementReward = (int) $args[6];
								if(!is_int($FifthtPlacementReward)){
									$sender->sendMessage("$prefix §c§oInvalid Cash amount! Cash must be be between $1-$10,000,000!");
								}elseif($FifthtPlacementReward < 1){
									$sender->sendMessage("$prefix §c§oInvalid Cash amount! Cash must be be more than $1!");
								}elseif($FifthtPlacementReward > 10000000){
									$sender->sendMessage("$prefix §c§oInvalid Cash amount! Cash must be be less than $10,000,000!");
								}
                                $this->plugin->btSetup["started"] = 1;
								$this->plugin->btSetup["time"] = $time;
								$this->plugin->btSetup["timestamp"] = time();
								$this->plugin->btSetup["prizetype"] = $prizetype;
								$this->plugin->btSetup["1stPlaceReward"] = $TopPlacementReward;
								$this->plugin->btSetup["2ndPlaceReward"] = $SecondPlacementReward;
								$this->plugin->btSetup["3rdPlaceReward"] = $ThridPlacementReward;
								$this->plugin->btSetup["4thPlaceReward"] = $ForthPlacementReward;
								$this->plugin->btSetup["5thPlaceReward"] = $FifthtPlacementReward;
								foreach($this->plugin->getServer()->getOnlinePlayer() as $pl){
									$pl->sendTitle("§1Block §4mining §dTournament §0Is §2Active");
									$pl->sendSubTitle("§6Mine as many blocks as you can to win!");
									$pl->sendMessage("§aTo See The Prize Amounts For The Top Prizes Do §6/btprizes");
								}
								}
							}
				        }
