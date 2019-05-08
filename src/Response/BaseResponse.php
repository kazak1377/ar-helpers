<?php
/**
 * User: kazak
 * Email: mk@altrecipe.com
 * Date: 2019-04-22
 * Time: 17:23
 */

namespace ArHelpers\Response;



use ArHelpers\Error\BaseError;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use function response;

abstract class BaseResponse {
	public $code = 200;
	public $message = "OK";
	public $data = [];
	public $error = NULL;
	public $warnings = NULL;

	public function toArray() {
		return [
			'code' => $this->code,
			'message' => $this->message,
			'data' => $this->data,
			'error' => $this->error,
			'warnings' => $this->warnings
		];
	}

	public function setData($data) {
		$this->data = $data;
		return $this;
	}

	public function setWarnings($warns) {
		$this->warnings = $warns;
		return $this;
	}

	public function setError(BaseError $error) {
		$this->error = $error;
		$this->code = $error->httpCode;
		$this->message = $error->message;
		return $this;
	}

	public function json() {
		return json_encode($this->toArray());
	}

	/**
	 * @return ResponseFactory|Response
	 */
	public function send() {
		try {
			return response($this->toArray(), 200);
		} catch (BindingResolutionException $e) {
			return new Response();
		}
	}
}
