<?php

namespace syouyu\SLS\Data\SQL;

use syouyu\SLS\Data\SQL\System\ColumnData;
use syouyu\SLS\Data\SQL\System\PrimaryKeyColumn;
use syouyu\SLS\Data\SQL\System\SQL;

class PlayerDataSQL extends SQL{

	public function __construct(string $configPath){
		parent::__construct(
			PrimaryKeyColumn::getPrimaryKeyColumn(self::SQL_INT, "id", null,true),
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
			TEXT ip NOT NULL"
		);
	}

	public function getDataFromId(int $id) : ?PlayerData{
		$sql = $this->getSQL();
		$prepare = $sql->prepare("SELECT * FROM ".$this->getName()." WHERE id = :id");
		$prepare->bindValue(":id", $id);
		$res = $prepare->execute();
		if($res === false) return null;
		$row = $res->fetchArray();
		if($row === false) return null;
		return new PlayerData(
			PrimaryKeyColumn::getPrimaryKeyColumn(self::SQL_INT, "id", $row["id"],true),
			ColumnData::getColumnData(self::SQL_TEXT, "xuid", $row["xuid"]),
			ColumnData::getColumnData(self::SQL_TEXT, "ip", $row["ip"]),
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