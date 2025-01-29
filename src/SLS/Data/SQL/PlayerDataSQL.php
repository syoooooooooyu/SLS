<?php

namespace syouyu\SLS\Data\SQL;

use syouyu\SLS\Data\SQL\System\ColumnData;
use syouyu\SLS\Data\SQL\System\IdColumn;
use syouyu\SLS\Data\SQL\System\SQL;
use syouyu\SLS\Data\SQL\System\TextColumn;

class PlayerDataSQL extends SQL{

	public function __construct(string $configPath){
		parent::__construct(
			IdColumn::getPrimaryKeyColumn(self::SQL_INT, "id", null,true),
			ColumnData::getColumnData(self::SQL_TEXT, "xuid"),
			ColumnData::getColumnData(self::SQL_TEXT, "ip"),
		);
		if(!file_exists($configPath."/SQL/".$this->getName()."-".$this->getVersion().".db")){
			file_put_contents($configPath."/SQL/".$this->getName()."-".$this->getVersion().".db","");
		}
		$this->sql = new \SQLite3($configPath."/SQL/".$this->getName()."-".$this->getVersion().".db");
		$this->sql->exec("CREATE TABLE IF NOT EXISTS ".$this->getName()."(
			INTEGER id PRIMARY KEY NOT NULL AUTO_INCREMENT,
			TEXT xuid NOT NULL,
			TEXT ip NOT NULL,
			TEXT pName NOT NULL"
		);
	}

	public function setData(PlayerData $playerData){

	}

	public function getDataFromId(int $id) : ?PlayerData{
		$sql = $this->getSQL();
		$prepare = $sql->prepare("SELECT * FROM ".$this->getName()." WHERE id = :id");
		$prepare->bindValue(":id", $id);
		return $this->sql($prepare);
	}

	public function getDataFromXuid(int $xuid) : ?PlayerData{
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