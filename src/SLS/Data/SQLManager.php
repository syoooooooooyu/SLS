<?php

declare(strict_types=1);

namespace syouyu\SLS\Data;

use syouyu\SLS\Data\SQL\PlayerDataSQL;
use syouyu\SLS\Data\SQL\System\SQL;

class SQLManager{

	/**
	 * @var SQL[]
	 */
	private static array $sql;

	private PlayerDataSQL $playerDataSQL;

	public function __construct(string $configPath){
		if(!file_exists($configPath."/SQL")) mkdir($configPath."/SQL");
		$this->playerDataSQL = new PlayerDataSQL($configPath);
	}

	public function getPlayerDataSQL() : PlayerDataSQL{
		return $this->playerDataSQL;
	}
}