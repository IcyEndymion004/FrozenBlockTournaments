<?php

namespace IcyEndymion004\Sessions;

use pocketmine\Player;

class SessionManager {

    /** @var Session[] */
    protected static $sessions;

    /**
     * @param Player|string $player
     */
    public static function open($player): void{
        self::$sessions[$player instanceof Player ? $player->getName() : strval($player)] = new Session($player);
    }

    /**
     * @param Player|string $player
     */
    public static function has($player): bool{
        return isset(self::$sessions[$player instanceof Player ? $player->getName() : strval($player)]);
    }

    /**
     * @param Player|string $player
     */
    public static function get($player): Session{
        if(self::has($player)){
            self::open($player);
        }
        return self::$sessions[$player instanceof Player ? $player->getName() : strval($player)];
    }

    /**
     * @return Session[]
     */
    public static function getSessions(): array{
        return self::$sessions;
    }

}