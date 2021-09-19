<?php

namespace IcyEndymion004\Tournament;

use IcyEndymion004\Loader;
use IcyEndymion004\Sessions\SessionManager;
use IcyEndymion004\Tournament\Tasks\TournamentTask;

class TournamentManager {


    protected static $isOpen = false;

    public static function isOpen(): bool{
        return self::$isOpen;
    }

    public static function setOpen(bool $bool = true): void{
        self::$isOpen = $bool;
        if($bool){
            Loader::getInstance()->getScheduler()->scheduleRepeatingTask(new TournamentTask(), 3);
        }else{
            Loader::getInstance()->heartbeatTask->timer = Loader::getInstance()->getConfig()->get("heartbeat-timer");
            self::reset();
        }
    }

    public static function reset(): void{
        foreach(SessionManager::getSessions() as $session){
            $session->setBlocksBroken(0);
        }
    }

}
