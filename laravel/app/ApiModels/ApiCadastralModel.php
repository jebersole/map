<?php

namespace App\ApiModels;


class ApiCadastralModel extends ApiSuccess {
	public $contract;
	public $data;

	public function __construct($cadastrals) {
		$this->contract = $contract;
		$this->data = $data;
	}//  __construct()
}