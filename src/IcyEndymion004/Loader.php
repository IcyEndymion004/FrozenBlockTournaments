<?php

namespace IcyEndymion004;

use IcyEndymion004\Tournament\Tasks\TournamentHeartbeatTask;
use pocketmine\plugin\PluginBase;
use IcyEndymion004\libs\muqsit\invmenu\InvMenuHandler;

class Loader extends PluginBase{

    /** @var self */
    protected static $instance;
    /** @var TournamentHeartbeatTask */
    public $heartbeatTask;

    public function onEnable(): void{
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

    public static function getInstance(): Loader{
        return self::$instance;
    }

}
