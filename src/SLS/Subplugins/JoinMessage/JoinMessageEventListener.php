<?php

declare(strict_types=1);

namespace syouyu\SLS\subplugins\JoinMessage;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\utils\TextFormat as TF;

class JoinMessageEventListener implements Listener{

	public function onJoin(PlayerJoinEvent $event){
		$player = $event->getPlayer();
		$event->setJoinMessage(TF::YELLOW.TF::BOLD."JOIN>>".TF::RESET.$player->getName()."様が入室しました！");
	}
}