<?php

namespace syouyu\SLS\Data\SQL\System;

class PrimaryKeyColumn extends ColumnData{

	protected function __construct(int $type, string $name, mixed $data, protected bool $autoIncrement){
		parent::__construct($type, $name, $data);
	}

	public static function getPrimaryKeyColumn(int $type, string $name, mixed $data, bool $autoIncrement) : PrimaryKeyColumn{
		return new PrimaryKeyColumn($type, $name, $autoIncrement, $data);
	}

	public function isAutoIncrement() : bool{
		return $this->autoIncrement;
	}
}