<?php

declare(strict_types=1);

namespace syouyu\SLS\subplugins\JoinMessage;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\lang\Translatable;
use pocketmine\utils\TextFormat;

class JoinMessageEventListener implements Listener{

	public function onJoin(PlayerJoinEvent $event){
		$player = $event->getPlayer();
		$event->setJoinMessage(TextFormat::YELLOW.TextFormat::BOLD."JOIN>>".TextFormat::RESET.$player->getName()."様が入室しました！");
	}
}