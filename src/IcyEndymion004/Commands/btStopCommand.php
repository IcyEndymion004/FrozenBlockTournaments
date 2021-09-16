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

class btStopCommand{


	public $bT = [];
	public $btSetup = [];

	public $plugin;

	public function __construct(Loader $plugin){
		$this->plugin = $plugin;
	}
	public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool{
		$smcmd = strtolower($cmd);
		$economy = $this->plugin->getServer()->getPluginManager()->getPlugin("EconomyAPI")->getInstance();
		$prefix = $this->getConfig()->get("prefix");
		switch($smcmd){
			case "btstop":
				if($this->plugin->isactive() !== false ){
				$sender->sendMessage("There Is No Tournament Active");
				return false;
				}
				$sender->sendMessage("§aYou Have Stoped The BLock Tournament");
                foreach($this->plugin->getServer()->getOnlinePlayer() as $pl){
                $pl->sendTitle("§a§lAn Admin Has Stopped The Block Tournament");
				$pl->sendSubTitle("§cNo Rewards Have Been Given Sorry");
				}

				unset($this->plugin->btSetup);
				unset($this->plugin->bT);

		}
	}
}
