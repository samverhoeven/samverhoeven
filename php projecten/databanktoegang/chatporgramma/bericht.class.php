<?php
class Bericht {
	private $id;
	private $nickname;
	private $boodschap;
	
	public function __construct($id, $nickname, $boodschap) {
		$this->id = $id;
		$this->nickname = $nickname;
		$this->boodschap = $boodschap;
	}
	
	public function getNickname() {
		return $this->nickname;
	}
	
	public function getBoodschap() {
		return $this->boodschap;
	}
}