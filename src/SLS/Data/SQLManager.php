<?php

declare(strict_types=1);

namespace syouyu\SLS\Data;

use pocketmine\Server;
use syouyu\SLS\Data\SQL\PlayerData;
use syouyu\SLS\Data\SQL\PlayerDataSQL;
use syouyu\SLS\Data\SQL\System\IdColumn;
use syouyu\SLS\Data\SQL\System\SQL;
use syouyu\SLS\Data\SQL\System\TextColumn;
use syouyu\SLS\Exceptions\CantLoadDatabaseException;
use syouyu\SLS\Main;

class SQLManager{

	private PlayerDataSQL $playerDataSQL;

	public function __construct(string $configPath){
		if(!file_exists($configPath."/SQL")) mkdir($configPath."/SQL");
		try{
			$this->playerDataSQL = new PlayerDataSQL($configPath);
		}catch(CantLoadDatabaseException $exception){
			Server::getInstance()->getLogger()->error($exception->getMessage()."がロードされていません！");
		}
	}

	public function getPlayerDataSQL() : PlayerDataSQL{
		return $this->playerDataSQL;
	}

	/**
	 * @return SQL[]
	 */
	public function getAllSQL(): array{
		return [
			$this->getPlayerDataSQL(),
		];
	}
}