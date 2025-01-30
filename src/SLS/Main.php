<?php

declare(strict_types=1);

namespace syouyu\SLS;

use pocketmine\plugin\PluginBase;
use syouyu\SLS\Data\SQLManager;
use syouyu\SLS\resources\ResourceManager;
use syouyu\SLS\subplugins\SubPluginInitializer;

class Main extends PluginBase{

	private SQLManager $SQLManager;
	private ResourceManager $resourceManager;

	public function onEnable() : void{
		// PRIORITY HIGH
		$this->resourceManager = new ResourceManager($this);
		$this->SQLManager = new SQLManager($this->getDataFolder());

		// PRIORITY LOW
		SubpluginInitializer::init($this);
	}
}