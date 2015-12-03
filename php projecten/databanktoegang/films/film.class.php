<?php
	class Film{
		private $id;
		private $titel;
		private $duurtijd;

		public function __construct($id, $titel, $duurtijd){
			$this->id = $id;
			$this->titel = $titel;
			$this->duurtijd = $duurtijd;
		}
		public function getId(){
			return $this->id;
		}
		public function getTitel(){
			return $this->titel;
		}
		public function getDuurtijd(){
			return $this->duurtijd;
		}
	}