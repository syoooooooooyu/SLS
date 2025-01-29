<?php

declare(strict_types=1);

namespace syouyu\SLS\Data\SQL\System;

class TextColumn extends ColumnData{

	public function __construct(string $name, string $value = null){
		parent::__construct(SQL::SQL_TEXT, $name, $value);
	}

	public function getText(): string{
		return parent::getValue();
	}
}