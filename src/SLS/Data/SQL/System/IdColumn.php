<?php

namespace syouyu\SLS\Data\SQL\System;

class IdColumn extends IntegerColumn{

	public function __construct(int $value = null){
		parent::__construct("id", $value);
	}
}