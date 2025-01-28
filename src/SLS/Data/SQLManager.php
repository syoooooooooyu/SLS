<?php

declare(strict_types=1);

namespace syouyu\SLS\Data;

use SQLite3;
use syouyu\SLS\Data\SQL\PlayerDataSQL;
use syouyu\SLS\Data\SQL\SQL;

class SQLManager{

	/**
	 * @var SQL[]
	 */
	private static array $sql;

	private static array $cache;

	public function __construct(string $configPath){
		self::init($configPath);
	}

	public static function init(string $configPath){
		self::$sql = [
			new PlayerDataSQL()
		];

		foreach(self::$sql as $sql){
			if(!file_exists($configPath."/".$sql->getName().$sql->getVersion().".db")){
				file_put_contents($configPath."/".$sql->getName().$sql->getVersion().".db", "");
			}
			$sqlite = new SQLite3($configPath."/".$sql->getName().$sql->getVersion().".db");
			$sqlite->exec("CREATE TABLE IF NOT EXISTS ".$sql->getName()." (".")");
		}
	}
}