<?php

declare(strict_types=1);

namespace syouyu\SLS\Data\SQL;

class ColumnData{

	protected function __construct(protected int $type, protected string $name){
		//NOOP
	}

	public static function getColumnData(int $type, string $name) : ColumnData{
		return new ColumnData($type, $name);
	}

	public function getType(): int{
		return $this->type;
	}

	public function getData(): string{
		return $this->data;
	}
}