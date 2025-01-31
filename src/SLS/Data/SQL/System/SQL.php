<?php

declare(strict_types=1);

namespace syouyu\SLS\Data\SQL\System;

use SQLite3;
use syouyu\SLS\Data\SQL\PlayerData;

abstract class SQL{

	const SQL_NULL = 1;
	const SQL_INT  = 2;
	const SQL_REAL = 3;
	const SQL_TEXT = 4;
	const SQL_BLOB = 5;

	public function __construct(private SQLite3 $sql){
	}

	protected function getSQL(): \SQLite3{
		return $this->sql;
	}

	public function onClose() : void{
		$this->sql->close();
	}

	abstract public function setData(PlayerData $playerData): void;
	abstract public function getData(int $id): ?PlayerData;
	abstract public function getName() : string;
	abstract public function getVersion(): string;
}