<?php

declare(strict_types=1);

namespace syouyu\SLS\Data\SQL;

use SQLite3;
use syouyu\SLS\resources\ResourceManager;

abstract class SQL{

	const SQL_NULL = 1;
	const SQL_INT  = 2;
	const SQL_REAL = 3;
	const SQL_TEXT = 4;
	const SQL_BLOB = 5;

	private PrimaryKeyColumn $keyColumn;
	/** @var ColumnData[] */
	private array $columns;

	protected string $version;

	public function __construct(PrimaryKeyColumn $keyColumn, ColumnData ...$columns){
		$this->keyColumn = $keyColumn;
		$this->columns = $columns;
	}

	abstract public function getName() : string;
	abstract public function getVersion(): string;
}