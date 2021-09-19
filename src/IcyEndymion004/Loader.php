<?php

namespace IcyEndymion004;

use IcyEndymion004\Tournament\Tasks\TournamentHeartbeatTask;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use IcyEndymion004\libs\muqsit\invmenu\InvMenuHandler;
use IcyEndymion004\Commands\btStartCommand;
use IcyEndymion004\Commands\btStopCommand;
use IcyEndymion004\Commands\btTopCommand;
use IcyEndymion004\Commands\btPrizesCommand;
use IcyEndymion004\Commands\btBrokenCommand;


class Loader extends PluginBase{

    /** @var self */
    protected static $instance;
    /** @var TournamentHeartbeatTask */
    public $heartbeatTask;

    public function onEnable(): void{

        $prefix = $this->getConfig()->get("prefix");
        $this->TournyData = new Config($this->getDataFolder() . "TournyData.yml", Config::YAML);
        $this->cmds = new btStartCommand($this);
		//$this->cmds = new btStopCommand($this);
		//$this->cmds = new btPrizesCommand($this);
		//$this->cmds = new btTopCommand($this);
		//$this->cmds = new btBrokenCommand($this);
        $this->saveDefaultConfig(); 
        $this->getScheduler()->scheduleRepeatingTask($this->heartbeatTask = new TournamentHeartbeatTask(), 20);
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
  if(!InvMenuHandler::isRegistered()){
    InvMenuHandler::register($this);
}
$this->getServer()->getLogger()->info("Frozen Block Tournaments enabled!");

    }

    public function onLoad(): void{
        self::$instance = $this;
    }
    public function getTournydata(): Config{
        return $this->TournyData;
    }
    public static function getInstance(): Loader{
        return self::$instance;
    }

}
