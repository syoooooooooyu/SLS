<?php

declare(strict_types=1);

namespace syouyu\SLS\subplugins\JoinMessage;

use syouyu\SLS\subplugins\SubPluginBase;

class JoinMessage extends SubPluginBase{

	public function onLoad() : void{
		$this->addEvent(new JoinMessageEventListener());
	}

	public function getVersion() : string{
		return "1.0.0";
	}

	public function getName() : string{
		return "JoinMessage";
	}

	public function getDescription() : string{
		return "JoinMessage";
	}
}