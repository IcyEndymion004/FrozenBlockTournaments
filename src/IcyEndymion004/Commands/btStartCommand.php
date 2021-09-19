<?php

namespace IcyEndymion004\Commands;

use pocketmine\command\Command;
use pocketmine\command\CommandExecutor;
use pocketmine\command\CommandSender;
use IcyEndymion004\Tournament\TournamentManager;
use pocketmine\Player;
use IcyEndymion004\Loader;
use pocketmine\Server;
use IcyEndymion004\libs\jojoe77777\FormAPI\CustomForm;


class btStartCommand implements CommandExecutor{

	public $plugin;
	public $TournyData;


	public function __construct(Loader $plugin){
		$this->plugin = $plugin;
		$plugin->getCommand("btstart")->setExecutor($this);
	}

	public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool{
		$smcmd = strtolower($cmd);
		$prefix = "§8[§1BT§8]§r";
		switch($smcmd){
			case "btstart":
				if(!isset($args[0])){
					$this->plugin->getCommand("btstart")->setUsage("$prefix §cUsage: §a/btstart <prize type> <1st Place Prize> <2nd Place Prize> <3rd Place Prize> <4th Place Prize> <5th Place Prize>", false);
					return true;
				};	
                                $prizetype = $args[0];
								Loader::getInstance()->getTournydata()->set("PrizeType", $prizetype);
								Loader::getInstance()->getTournydata()->save();
								if($args[0] == "cash"){
                                    $form = new CustomForm(function(Player $player, $data){
									$TopPlacementReward = $data[1];
                                    $SecondPlacementReward = $data[2];
                                    $ThridPlacementReward = $data[3];
                                    $ForthPlacementReward = $data[4];
                                    $FifthtPlacementReward = $data[5];
									Loader::getInstance()->getTournydata()->set("TopPlacementReward", $TopPlacementReward);
									Loader::getInstance()->getTournydata()->set("SecondPlacementReward", $SecondPlacementReward);
									Loader::getInstance()->getTournydata()->set("ThridPlacementReward", $ThridPlacementReward);
									Loader::getInstance()->getTournydata()->set("ForthPlacementReward", $ForthPlacementReward);
									Loader::getInstance()->getTournydata()->set("FifthtPlacementReward", $FifthtPlacementReward);
									Loader::getInstance()->getTournydata()->save();							
									});
									$form->setTitle("§aPrizeType§8: §6Cash");
									$form->addLabel("§eCash Reward");
									$form->addInput("§61stPlaceReward", "§dMake Sure this Is a number");
									$form->addInput("§72ndPlaceReward", "§dMake Sure this Is a number");
									$form->addInput("§c3rdPlaceReward", "§dMake Sure this Is a number");
									$form->addInput("§e4thPlaceReward", "§dMake Sure this Is a number");
									$form->addInput("§95thPlaceReward", "§dMake Sure this Is a number");
									$sender->sendForm($form);
							    } 
								}
								foreach(Server::getInstance()->getOnlinePlayers() as $pl){
								$this->TournyTitle($pl);
								}
								return true;
							}
							public function TournyTitle(): void{
									TournamentManager::setOpen(true);
									foreach(Server::getInstance()->getOnlinePlayers() as $pl){
										$pl->sendTitle("§1Block §4mining §dTournament §0Is §2Active");
										$pl->sendSubTitle("§6Mine as many blocks as you can to win!");
										$pl->sendMessage("§aTo See The Prize Amounts For The Top Prizes Do §6/btprizes");
									}
							}
				        }
