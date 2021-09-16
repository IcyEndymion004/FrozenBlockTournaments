<?php

namespace IcyEndymion004;

#PocketmineTaks
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;
use pocketmine\scheduler\Task;
use pocketmine\scheduler\TaskScheduler;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\Server;
use pocketmine\event\Listener;
use pocketmine\utils\Config;

#Other Plugin Things
use IcyEndymion004\libs\CortexPE\Commando\BaseCommand;
use IcyEndymion004\libs\CortexPE\Commando\PacketHooker;
use IcyEndymion004\libs\jojoe77777\FormAPI\Form;
use IcyEndymion004\libs\muqsit\invmenu\InvMenuHandler;


#Plugin Stuff
use IcyEndymion004\Tasks\BlockTourneyTask;
use IcyEndymion004\EventListener;
use IcyEndymion004\Commands\btStartCommand;
use IcyEndymion004\Commands\btStopCommand;
use IcyEndymion004\Commands\btTopCommand;
use IcyEndymion004\Commands\btPrizesCommand;
use IcyEndymion004\Commands\btBrokenCommand;


class Loader extends PluginBase{

	public $bT = [];
	public $btSetup = [];

	public $plugin;

	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
		$this->cmds = new btStartCommand($this);
		$this->cmds = new btStopCommand($this);
		//$this->cmds = new btPrizesCommand($this);
		//$this->cmds = new btTopCommand($this);
		//$this->cmds = new btBrokenCommand($this);
		$this->getScheduler()->scheduleRepeatingTask(new BlockTourneyTask($this), 5);
		$this->getServer()->getLogger()->info("Frozen Block Tournaments enabled!");
		if(!InvMenuHandler::isRegistered()){
			InvMenuHandler::register($this);
		}
		if (!PacketHooker::isRegistered()){
		 PacketHooker::register($this);
		}
		if (!$this->getConfig()->exists("config-version")) {
			$this->getLogger()->notice("§eYour configuration file is from another version. Updating the Config...");
			$this->getLogger()->notice("§eThe old configuration file can be found at config_old.yml");
			rename($this->getDataFolder()."config.yml", $this->getDataFolder()."config_old.yml");
			$this->saveResource("config.yml");
			return;
	  }
	  if (version_compare("0.0.1", $this->getConfig()->get("config-version"))) {
	  $this->getLogger()->notice("§eYour configuration file is from another version. Updating the Config...");
			$this->getLogger()->notice("§eThe old configuration file can be found at config_old.yml");
			rename($this->getDataFolder()."config.yml", $this->getDataFolder()."config_old.yml");
			$this->saveResource("config.yml");
			return;
  }
	}
	public function isactive($default = false){
		if(!isset($this->btSetup["time"])){
		if(!isset($this->btSetup["started"])){
			return true;
		}
	}
	}
}
