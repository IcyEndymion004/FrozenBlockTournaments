<?php

namespace IcyEndymion004\Tournament\Tasks;

use IcyEndymion004\Loader;
use IcyEndymion004\Tournament\TournamentManager;
use IcyEndymion004\Sessions\SessionManager;
use IcyEndymion004\Sessions\Session;
use IcyEndymion004\Commands\btStartCommand;
use pocketmine\scheduler\Task;
use pocketmine\utils\Config;
use pocketmine\Server;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use IcyEndymion004\Tournament\Tasks\TournamentPopupTask;

class TournamentTask extends Task {

    protected $timer;
    public $TournyData;

    public function __construct(){
        $this->timer = Loader::getInstance()->getConfig()->get("event-timer");
    }
    public function getTournydata(): Config{
        return $this->TournyData;
    }

    public function onRun(int $currentTick): bool{
        if($this->timer > 0 ){
        Loader::getInstance()->getScheduler()->scheduleRepeatingTask(new TournamentPopupTask(), 3);
        foreach(SessionManager::getSessions() as $session){
            foreach(Server::getInstance()->getOnlinePlayers() as $p){
            $player = $session->getPlayer();
            $blocksbroken = $player->getBlocksBroken();
            $elapsed = $this->timer - time();
                $p->sendPopup("Your blocks mined: " . "$blocksbroken" . "\n" . "Time left: "  . "$elapsed" . " seconds" );
            }
        }    
        }else{
            $top = [];
            foreach(SessionManager::getSessions() as $session){
            $top[$session->getPlayer()] = $session->getBlocksBroken();
            arsort($top);
            $firstplace = isset($top[0]) ? SessionManager::get($top[0]) : null;
            $secondplace = isset($top[1]) ? SessionManager::get($top[1]) : null;
            $thirdplace = isset($top[2]) ? SessionManager::get($top[2]) : null;
            $fourthplace = isset($top[3]) ? SessionManager::get($top[3]) : null;
            $fifthplace = isset($top[4]) ? SessionManager::get($top[4]) : null;
            foreach(Server::getInstance()->getOnlinePlayers() as $p){
            $econ = Server::getInstance()->getPluginManager()->getPlugin("EconomyAPI")->getInstance();
            $player = $session->getPlayer();
            $blocksbroken = $player->getBlocksBroken();
            }
            $p->sendTitle("§l§9Block Mining Tournament Is Over");
            $p->sendSubTitle("§eRewards Have Been Given To the Winners");
            $p->sendMessage("§8》----------------------------------《");
            $p->sendMessage("§8• §1Here Are the Top Players In The Mining Tournament");
            $p->sendMessage("§6☆ §6$firstplace §awith§6" . $firstplace->getBlocksBroken() . "§aBlocks Broken");
            $p->sendMessage("§7☆ §6$secondplace §awith§6" . $secondplace->getBlocksBroken() . "§aBlocks Broken");
            $p->sendMessage("§3☆ §6$thirdplace §awith§6" . $thirdplace->getBlocksBroken() . "§aBlocks Broken");
            $p->sendMessage("§e☆ §6$fourthplace §awith§6" . $fourthplace->getBlocksBroken() . "§aBlocks Broken");
            $p->sendMessage("§d☆ §6$fifthplace §awith§6" . $fifthplace->getBlocksBroken() . "§aBlocks Broken");
            $p->sendMessage("§8• §cThey Have Been Given There Rewards");
            $p->sendMessage("§8》----------------------------------《");
            $p->sendPopup("§aThank you All For Playing In This Block Tournament");
            $player->sendMessage("§aYou Have Gotten §6$blocksbroken §aBlocks Broken");
            if($this->getTournydata()->get("PrizeType") == "cash"){
            $econ->addMoney($firstplace, $this->getTournydata()->get("TopPlacementReward"));
            $econ->addMoney($secondplace, $this->getTournydata()->get("SecondPlacementReward"));
            $econ->addMoney($thirdplace, $this->getTournydata()->get("ThridPlacementReward"));
            $econ->addMoney($fourthplace, $this->getTournydata()->get("ForthPlacementReward"));
            $econ->addMoney($fifthplace, $this->getTournydata()->get("FifthtPlacementReward"));
            }
            }
            if(file_exists("TournyData.yml")){
            unlink(Loader::getInstance()->getDataFolder(). "TournyData.yml");
            TournamentManager::setOpen(false);
            } 
        }
        
        return true;
    }
}
