<?php
/**
 * User: kazak
 * Email: mk@altrecipe.com
 * Date: 2019-04-24
 * Time: 18:56
 */
namespace ArHelpers\Errors;

use ArHelpers\Error\BaseError;

class DeletingError extends BaseError {
	public $httpCode = 400;
	public $code = '61';
	public $message = "Can't delete ";

	public function __construct($entityName) {
		$this->message = $this->message.$entityName;
		parent::__construct();
	}
}