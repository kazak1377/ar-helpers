<?php
/**
 * User: kazak
 * Email: mk@altrecipe.com
 * Date: 2019-04-24
 * Time: 18:56
 */
namespace ArHelpers\Errors;

use ArHelpers\Error\BaseError;

class NoSuchEntityError extends BaseError {
	public $httpCode = 404;
	public $message = "entity not found";

	public function __construct($entityName) {
		$this->message = $entityName." ".$this->message;
		parent::__construct();
	}
}