<?php

namespace IcyEndymion004;

use IcyEndymion004\Sessions\SessionManager;
use IcyEndymion004\Tournament\TournamentManager;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;

class EventListener implements Listener{

    public function onBreak(BlockBreakEvent $event): void{
        if(TournamentManager::isOpen()){
            $player = $event->getPlayer();
            $session = SessionManager::get($player);
            $session->incrementBlocksBroken();
        }
    }

}
	