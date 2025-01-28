<?php

declare(strict_types=1);

namespace syouyu\SLS\Data\SQL\System;

class ColumnData{

	protected function __construct(protected int $type, protected string $name, protected mixed $value = null){
		//NOOP
	}

	public static function getColumnData(int $type, string $name, mixed $data = null) : ColumnData{
		return new ColumnData($type, $name, $data);
	}

	public function getType(): int{
		return $this->type;
	}

	public function getName(): string{
		return $this->name;
	}

	public function getValue(): mixed{
		return $this->value;
	}
}