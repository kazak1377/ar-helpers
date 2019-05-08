<?php
/**
 * User: kazak
 * Email: mk@altrecipe.com
 * Date: 2019-04-22
 * Time: 16:54
 */

namespace ArHelpers\Error;


use Illuminate\Contracts\Container\BindingResolutionException;

abstract class BaseError implements iError {
	public $message;
	public $code;
	public $description = '';
	public $httpCode = 400;

	public function __toString() {
		return json_encode($this->toArray());
	}

	public function __construct() {
		try {
			$this->code = config('app.errorPrefix') . $this->code;
		} catch (BindingResolutionException $e) {
			$this->code = "00".$this->code;
		}
	}

	public function toArray() {
		return [
			'code' => $this->code,
			'message' => $this->message,
			'desc' => $this->description,
		];
	}
}