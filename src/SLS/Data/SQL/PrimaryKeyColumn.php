<?php

namespace syouyu\SLS\Data\SQL;

class PrimaryKeyColumn extends ColumnData{

	protected function __construct(int $type, string $name, protected bool $autoIncrement){
		parent::__construct($type, $name);
	}

	public static function getPrimaryKeyColumn(int $type, string $name, bool $autoIncrement) : PrimaryKeyColumn{
		return new PrimaryKeyColumn($type, $name, $autoIncrement);
	}

	public function isAutoIncrement() : bool{
		return $this->autoIncrement;
	}
}