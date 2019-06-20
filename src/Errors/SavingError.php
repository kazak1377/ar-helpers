<?php
/**
 * User: kazak
 * Email: mk@altrecipe.com
 * Date: 2019-04-24
 * Time: 18:56
 */
namespace ArHelpers\Errors;

use ArHelpers\Error\BaseError;

class SavingError extends BaseError {
	public $httpCode = 400;
	public $message = "Can't save ";

	public function __construct($entityName) {
		$this->message = $this->message.$entityName;
		parent::__construct();
	}
}