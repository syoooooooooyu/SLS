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

	private IdColumn $keyColumn;
	/** @var ColumnData[] */
	private array $columns;
	protected string $version;

	public function __construct(protected SQLite3 $sql, IdColumn $keyColumn, ColumnData ...$columns){
		$this->keyColumn = $keyColumn;
		$this->columns = $columns;
	}

	protected function getSQL(): \SQLite3{
		return $this->sql;
	}

	abstract public function setData(PlayerData $playerData): bool;
	abstract public function updateData(PlayerData $playerData): bool;
	abstract public function getData(int $id): ?PlayerData;
	abstract public function getName() : string;
	abstract public function getVersion(): string;
}