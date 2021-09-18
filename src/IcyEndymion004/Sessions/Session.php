<?php

namespace IcyEndymion004\Sessions;

use pocketmine\OfflinePlayer;
use pocketmine\Player;
use pocketmine\Server;

class Session {

    protected $name;
    protected $player;
    protected $blocksBroken = 0;

    public function __construct($player){
        $this->name = $player instanceof Player ? $player->getName() : strval($player);
        $this->player = Server::getInstance()->getPlayer($this->name);
    }

    /**
     * @return OfflinePlayer|Player
     */
    public function getPlayer() {
        return $this->player ?? Server::getInstance()->getOfflinePlayer($this->name);
    }

    public function isOnline(): bool{
        return $this->getPlayer()->isOnline();
    }

    public function getBlocksBroken(): int{
        return $this->blocksBroken;
    }

    public function setBlocksBroken(int $blocksBroken): void{
        $this->blocksBroken = $blocksBroken <= 0 ? 0 : $blocksBroken;
    }

    public function incrementBlocksBroken(): void{
        $this->blocksBroken++;
    }

}