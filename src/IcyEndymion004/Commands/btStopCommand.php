<?php

namespace IcyEndymion004\Commands;

use pocketmine\command\Command;
use pocketmine\command\CommandExecutor;
use pocketmine\command\CommandSender;
use pocketmine\item\Item;
use pocketmine\utils\TextFormat;
use IcyEndymion004\Loader;
use IcyEndymion004\libs\jojoe77777\FormAPI\Form;
use IcyEndymion004\libs\jojoe77777\FormAPI\CustomForm;

class btStopCommand{

	public $plugin;

	public function __construct(Loader $plugin){
		$this->plugin = $plugin;
	}


}