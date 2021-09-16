<?php

namespace IcyEndymion004;

use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;
use pocketmine\network\mcpe\protocol\LevelSoundEventPacket;
use IcyEndymion004\Loader;

class EventListener implements Listener{

	public function __construct(Loader $plugin){
		$this->plugin = $plugin;
	}

	/**
	 * @priority        HIGHEST
	 * @ignoreCancelled true
	 */
	public function blockBreak(BlockBreakEvent $e){
		$p = $e->getPlayer();
		$b = $e->getBlock();
		if($this->plugin->blockTourney() == true){
			if(!isset($this->plugin->bT[$p->getName()])){
				$this->plugin->bT[$p->getName()] = 1;
			}else{
				$this->plugin->bT[$p->getName()] = $this->plugin->bT[$p->getName()] + 1;
			}
			return LevelSoundEventPacket::SOUND_NOTE;
		}
	}
}
	