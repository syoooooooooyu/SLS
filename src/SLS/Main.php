<?php

declare(strict_types=1);

namespace syouyu\SLS;

use pocketmine\plugin\PluginBase;
use pocketmine\plugin\PluginManager;
use syouyu\SLS\resources\ResourceManager;
use syouyu\SLS\subplugins\SubPluginInitializer;

class Main extends PluginBase{

	public function onEnable() : void{
		// PRIORITY HIGH
		new ResourceManager($this);

		// PRIORITY LOW
		SubpluginInitializer::init($this);
	}
}