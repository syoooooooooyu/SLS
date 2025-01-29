<?php

declare(strict_types=1);

namespace syouyu\SLS\Data\SQL\System;

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
	protected \SQLite3 $sql;

	public function __construct(IdColumn $keyColumn, ColumnData ...$columns){
		$this->keyColumn = $keyColumn;
		$this->columns = $columns;
	}

	abstract protected function getSQL(): \SQLite3;
	abstract public function getName() : string;
	abstract public function getVersion(): string;
}