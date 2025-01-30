<?php

declare(strict_types=1);

namespace syouyu\SLS\Data\SQL\System;

abstract class ColumnData{

	public function __construct(public int $type, public string $name, public mixed $value = null){
		//NOOP
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