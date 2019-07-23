<?php
/**
 * User: kazak
 * Email: mk@altrecipe.com
 * Date: 2019-04-24
 * Time: 18:56
 */
namespace ArHelpers\Errors;

use ArHelpers\Error\BaseError;

class ValidationError extends BaseError {
	public $httpCode = 400;
    public $code = '66';
	public $message = "validation error";

	public function __construct($entityName) {
		$this->message = $entityName." ".$this->message;
		parent::__construct();
	}
}