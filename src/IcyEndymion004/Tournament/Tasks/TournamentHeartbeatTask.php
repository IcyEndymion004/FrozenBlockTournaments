<?php

namespace IcyEndymion004\Tournament\Tasks;

use IcyEndymion004\Loader;
use IcyEndymion004\Tournament\TournamentManager;
use pocketmine\scheduler\Task;

class TournamentHeartbeatTask extends Task {

    public $timer;

    public function __construct(){
        $this->timer = intval(Loader::getInstance()->getConfig()->get("timer"));
    }

    public function onRun(int $currentTick): void{
        if($this->timer > 0) {
            $this->timer--;
        }else{
            TournamentManager::setOpen();
        }
    }

}