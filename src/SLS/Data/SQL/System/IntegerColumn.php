<?php

namespace syouyu\SLS\Data\SQL\System;

class IntegerColumn extends ColumnData{

	public function __construct(string $name, int $value = null){
		parent::__construct(SQL::SQL_INT, $name, $value);
	}

	public function getInt(): int{
		return parent::getValue();
	}
}