<?php

namespace App\Models\Dealer;

trait TGettersSetters {

	
	/** @return ?int */
	public function GetId () {
		return $this->id;
	}
	/**
	 * @param  ?int $id
	 * @return static
	 */
	public function SetId ($id) {
		$this->id = $id;
		return $this;
	}

	/** @return ?int */
	public function GetIdParent () {
		return $this->idParent;
	}
	/**
	 * @param  ?int $idParent
	 * @return static
	 */
	public function SetIdParent ($idParent) {
		$this->idParent = $idParent;
		return $this;
	}

	/** @return string */
	public function GetName () {
		return $this->name;
	}
	/**
	 * @param  string $name
	 * @return static
	 */
	public function SetName ($name) {
		$this->name = $name;
		return $this;
	}

	/** @return ?string */
	public function GetSurname () {
		return $this->surname;
	}
	/**
	 * @param  ?string $surname
	 * @return static
	 */
	public function SetSurname ($surname) {
		$this->surname = $surname;
		return $this;
	}

	/** @return ?string */
	public function GetDescription () {
		return $this->description;
	}
	/**
	 * @param  ?string $description
	 * @return static
	 */
	public function SetDescription ($description) {
		$this->description = $description;
		return $this;
	}

	/** @return float */
	public function GetTurnOverExclVat () {
		return $this->turnOverExclVat;
	}
	/**
	 * @param  float $turnOverExclVat
	 * @return static
	 */
	public function SetTurnOverExclVat ($turnOverExclVat) {
		$this->turnOverExclVat = $turnOverExclVat;
		return $this;
	}

	/** @return float */
	public function GetTurnOverInclVat () {
		return $this->turnOverInclVat;
	}
	/**
	 * @param  float $turnOverInclVat
	 * @return static
	 */
	public function SetTurnOverInclVat ($turnOverInclVat) {
		$this->turnOverInclVat = $turnOverInclVat;
		return $this;
	}


}
