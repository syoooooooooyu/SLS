<?php

namespace syouyu\SLS\Data\SQL;

use syouyu\SLS\Data\SQL\System\IdColumn;
use syouyu\SLS\Data\SQL\System\SQL;
use syouyu\SLS\Data\SQL\System\TextColumn;

class PlayerDataSQL extends SQL{

	public function __construct(string $configPath){
		if(!file_exists($configPath."/SQL/".$this->getName()."-".$this->getVersion().".db")){
			file_put_contents($configPath."/SQL/".$this->getName()."-".$this->getVersion().".db","");
		}
		parent::__construct(
			new \SQLite3($configPath."/SQL/".$this->getName()."-".$this->getVersion().".db"),
			new IdColumn(null),
			new TextColumn("xuid", null),
			new TextColumn("ip", null),
			new TextColumn("pName", null),
		);
		$this->sql->exec("CREATE TABLE IF NOT EXISTS ".$this->getName()."(
			id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL ,
			xuid TEXT NOT NULL,
			ip TEXT NOT NULL,
			pName TEXT NOT NULL
			);"
		);
	}

	public function setData(PlayerData $playerData): bool{
		$sql = $this->sql;
		$prepare = $sql->prepare(
			"INSERT INTO ".$this->getName()." VALUES (
			:id,
			:xuid,
			:ip,
			:pName
			);"
		);
		$prepare->bindValue("id", $playerData->getPrimaryKey());
		$prepare->bindValue("xuid", $playerData->getXuid());
		$prepare->bindValue("ip", $playerData->getIp());
		$prepare->bindValue("pName", $playerData->getPlayerName());
		return $prepare->execute() != false;
	}

	public function updateData(PlayerData $playerData): bool{
		$sql = $this->sql;
		$prepare = $sql->prepare("UPDATE ".$this->getName()." SET xuid = :xuid, ip = :ip, pName = :pName WHERE id = :id");
		$prepare->bindValue("id", $playerData->getPrimaryKey());
		$prepare->bindValue("xuid", $playerData->getXuid());
		$prepare->bindValue("ip", $playerData->getIp());
		$prepare->bindValue("pName", $playerData->getPlayerName());
		return $prepare->execute() != false;
	}

	public function getData(int $id) : ?PlayerData{
		$sql = $this->getSQL();
		$prepare = $sql->prepare("SELECT * FROM ".$this->getName()." WHERE id = :id");
		$prepare->bindValue(":id", $id);
		return $this->sql($prepare);
	}

	public function getDataFromXuid(string $xuid) : ?PlayerData{
		$sql = $this->getSQL();
		$prepare = $sql->prepare("SELECT * FROM ".$this->getName()." WHERE xuid = :xuid");
		$prepare->bindValue(":xuid", $xuid);
		return $this->sql($prepare);
	}

	private function sql(\SQLite3Stmt $sql) : ?PlayerData{
		$res = $sql->execute();
		if($res === false) return null;
		$row = $res->fetchArray();
		if($row === false) return null;
		return new PlayerData(
			new IdColumn($row["id"]),
			new TextColumn("xuid", $row["xuid"]),
			new TextColumn("ip", $row["ip"]),
			new TextColumn("pName", $row["pName"])
		);
	}

	public function getName() : string{
		return "PlayerData";
	}

	public function getVersion() : string{
		return "V1";
	}

	protected function getSQL() : \SQLite3{
		return $this->sql;
	}
}