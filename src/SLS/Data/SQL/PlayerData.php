<?php

namespace syouyu\SLS\Data\SQL;

use syouyu\SLS\Data\SQL\System\ColumnData;
use syouyu\SLS\Data\SQL\System\PrimaryKeyColumn;

class PlayerData{

	public function __construct(
		PrimaryKeyColumn $primaryKey,
		ColumnData $xuid,
		ColumnData $ip,
	){
		$this->primaryKey = $primaryKey;
		$this->xuid = $xuid;
		$this->ip = $ip;
	}

	public function getPrimaryKey() : PrimaryKeyColumn{
		return $this->primaryKey->getValue();
	}

	public function getXuid() : string{
		return $this->xuid->getValue();
	}

	public function getIp() : string{
		return $this->ip->getValue();
	}
}