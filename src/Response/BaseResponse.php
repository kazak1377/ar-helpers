<?php
/**
 * User: kazak
 * Email: mk@altrecipe.com
 * Date: 2019-04-22
 * Time: 17:23
 */

namespace ArHelpers\Response;



use ArHelpers\Error\BaseError;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use function response;

abstract class BaseResponse {
	public $code = 200;
	public $message = "OK";
	public $data = [];
	/** @var null|BaseError|array */
	public $error = null;

	public $warnings = NULL;

	public function toArray() {
		if (is_subclass_of($this->error, BaseError::class)) {
			$this->error = $this->error->toArray();
		}

		return [
			'code' => $this->code,
			'message' => $this->message,
			'data' => $this->data,
			'error' => $this->error,
			'warnings' => $this->warnings
		];
	}

	public function hasErrors() {
		return $this->error !== null;
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
		} catch (Exception $e) {
			return new Response();
		}
	}
}
