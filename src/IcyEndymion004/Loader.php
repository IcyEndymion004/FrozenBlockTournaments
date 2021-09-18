<?php

namespace IcyEndymion004;

use IcyEndymion004\Tournament\Tasks\TournamentHeartbeatTask;
use pocketmine\plugin\PluginBase;

class Loader extends PluginBase{

    /** @var self */
    protected static $instance;
    /** @var TournamentHeartbeatTask */
    public $heartbeatTask;

    public function onEnable(): void{
        $this->saveDefaultConfig();
        $this->getScheduler()->scheduleRepeatingTask($this->heartbeatTask = new TournamentHeartbeatTask(), 20);
    }

    public function onLoad(): void{
        self::$instance = $this;
    }

    public static function getInstance(): Loader{
        return self::$instance;
    }

}
