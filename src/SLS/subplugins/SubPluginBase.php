<?php

declare(strict_types=1);

namespace syouyu\SLS\subplugins;

use pocketmine\event\Listener;

abstract class SubPluginBase{

	private array $events = [];

	public function __construct(){
	}

	protected function addEvent(Listener $listener){
		$this->events[] = $listener;
	}

	public function getEvents() : array{
		return $this->events;
	}

	abstract public function onLoad(): void;
	abstract public function getVersion(): string;
	abstract public function getName(): string;
	abstract public function getDescription(): string;
}