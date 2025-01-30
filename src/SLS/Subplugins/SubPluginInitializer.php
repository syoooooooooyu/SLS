<?php

declare(strict_types=1);

namespace syouyu\SLS\subplugins;

use pocketmine\event\Listener;
use syouyu\SLS\Main;
use syouyu\SLS\subplugins\JoinMessage\JoinMessage;

class SubPluginInitializer{

	/**
	 * @var Listener[]
	 */
	private static array $loadPlugin;

	public static function init(Main $main){
		self::$loadPlugin = [
			new JoinMessage(),
		];

		foreach(self::$loadPlugin as $plugin){
			$plugin->onLoad();
			foreach($plugin->getEvents() as $event){
				$main->getServer()->getPluginManager()->registerEvents($event, $main);
			}
		}
	}
}