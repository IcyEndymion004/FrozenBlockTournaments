<?php

namespace IcyEndymion004\Tournament\Tasks;

use IcyEndymion004\Loader;
use IcyEndymion004\Tournament\TournamentManager;
use pocketmine\scheduler\Task;

class TournamentTask extends Task {

    protected $timer;

    public function __construct(){
        $this->timer = Loader::getInstance()->getConfig()->get("event-timer");
    }

    public function onRun(int $currentTick): void{
        if($this->timer > 0){
            $this->timer--;
        }else{
            TournamentManager::setOpen(false);

            // when the event finishes, run the code where you reward all players here.
        }
    }
}