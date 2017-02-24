<?php

class Outlay{
	protected $uuid;

	public function __construct(){
		$this->uuid = $this->hash->createUUID();
	}
}