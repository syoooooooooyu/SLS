<?php

declare(strict_types=1);

namespace syouyu\SLS\resources;

use syouyu\SLS\Main;

class ResourceManager{

	/** @var array{string: string} */
	private static array $resources = [];

	public function __construct(Main $plugin){
		/** @var array{string: string} $resourcePath */
		static $resourcePath = [
			// Write down
		];
		foreach($resourcePath as $path => $name){
			$resource = $plugin->getResourcePath($path);
			self::$resources[$name] = $resource;
		}
	}

	public static function isResourceAvailable(string $name): bool{
		return isset(self::$resources[$name]);
	}

	public static function getResource(string $name): ?string{
		return self::$resources[$name] ?? null;
	}
}