<?php

namespace syouyu\SLS\Data\SQL;

use syouyu\SLS\Data\SQL\System\IdColumn;
use syouyu\SLS\Data\SQL\System\SQL;
use syouyu\SLS\Data\SQL\System\TextColumn;
use syouyu\SLS\Exceptions\CantLoadDatabaseException;

class PlayerDataSQL extends SQL{

	/** @var PlayerData[] */
	private array $cache;

	/**
	 * @throws CantLoadDatabaseException
	 */
	public function __construct(string $configPath){
		if(!file_exists($configPath."/SQL/".$this->getName()."-".$this->getVersion().".db")){
			file_put_contents($configPath."/SQL/".$this->getName()."-".$this->getVersion().".db","");
		}
		parent::__construct(
			new \SQLite3($configPath."/SQL/".$this->getName()."-".$this->getVersion().".db")
		);
		$this->getSQL()->exec("CREATE TABLE IF NOT EXISTS ".$this->getName()."(
			id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL ,
			xuid TEXT NOT NULL,
			ip TEXT NOT NULL,
			pName TEXT NOT NULL
			);"
		);

		$prepare = $this->getSQL()->prepare("SELECT * FROM {$this->getName()}");
		$result = $prepare->execute();

		while(($res = $result->fetchArray(SQLITE3_ASSOC)) != false){
			if(!isset($res["id"], $res["xuid"], $res["ip"], $res["pName"])) throw new CantLoadDatabaseException($this->getName());
			$this->cache[$res["id"]] = new PlayerData(
				new IdColumn($res["id"]),
				new TextColumn("xuid", $res["xuid"]),
				new TextColumn("ip", $res["ip"]),
				new TextColumn("pName", $res["pName"]),
			);
		}
	}

	public function onClose() : void{
		foreach($this->cache as $keyId => $playerData){
			$prepare = $this->getSQL()->prepare("INSERT OR REPLACE INTO {$this->getName()} VALUES (:id, :xuid, :ip, :pName)");
			$prepare->bindValue(":id",$keyId, SQLITE3_INTEGER);
			$prepare->bindValue(":xuid",$playerData->getXuid());
			$prepare->bindValue(":ip",$playerData->getIp());
			$prepare->bindValue(":pName",$playerData->getPlayerName());
			$prepare->execute();
		}
		parent::onClose();
	}

	public function getName() : string{
		return "PlayerData";
	}

	public function getVersion() : string{
		return "V1";
	}

	public function setData(PlayerData $playerData) : void{
		$this->cache[$playerData->getPrimaryKey()] = $playerData;
	}

	public function getData(int $id) : ?PlayerData{
		return $this->cache[$id] ?? null;
	}

	public function getDataFromXuid(string $xuid) : ?PlayerData{
		foreach($this->cache as $id => $playerData){
			if($playerData->getXuid() == $xuid) return $playerData;
		}
		return null;
	}

	public function getMinAvailableId(): int{
		if(empty($this->cache)) return 1;
		return array_key_last($this->cache) + 1;
	}
}