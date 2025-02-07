<?php

namespace syouyu\SLS\Data\SQL;

use syouyu\SLS\Data\SQL\System\ColumnData;
use syouyu\SLS\Data\SQL\System\IdColumn;
use syouyu\SLS\Data\SQL\System\TextColumn;

class PlayerData{

	private ColumnData $playerName;
	private ColumnData $ip;
	private ColumnData $xuid;
	private IdColumn $primaryKey;

	public function __construct(
		IdColumn $primaryKey,
		TextColumn $xuid,
		TextColumn $ip,
		TextColumn $playerName,
	){
		$this->primaryKey = $primaryKey;
		$this->xuid = $xuid;
		$this->ip = $ip;
		$this->playerName = $playerName;
	}

	public function getPrimaryKey() : ?int{
		return $this->primaryKey->getInt();
	}

	public function getXuid() : string{
		return $this->xuid->getText();
	}

	public function setXuid(string $xuid) : void{
		$this->xuid->value = $xuid;
	}

	public function getIp() : string{
		return $this->ip->getText();
	}

	public function setIp(string $ip) : void{
		$this->ip->value = $ip;
	}

	public function getPlayerName() : string{
		return $this->playerName->getText();
	}

	public function setPlayerName(string $playerName) : void{
		$this->playerName->value = $playerName;
	}
}