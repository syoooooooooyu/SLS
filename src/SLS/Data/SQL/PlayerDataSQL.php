<?php

namespace syouyu\SLS\Data\SQL;

class PlayerDataSQL extends SQL{

	public function __construct(){
		parent::__construct(
			PrimaryKeyColumn::getPrimaryKeyColumn(self::SQL_INT, "id", true),
			ColumnData::getColumnData(self::SQL_TEXT, "xuid"),
			ColumnData::getColumnData(self::SQL_TEXT, "ip"),
		);
	}

	public function getName() : string{
		return "PlayerData";
	}

	public function getVersion() : string{
		return "V1";
	}
}