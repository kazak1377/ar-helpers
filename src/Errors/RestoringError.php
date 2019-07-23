<?php
/**
 * User: kazak
 * Email: mk@altrecipe.com
 * Date: 2019-04-24
 * Time: 18:56
 */
namespace ArHelpers\Errors;

use ArHelpers\Error\BaseError;

class RestoringError extends BaseError {
	public $httpCode = 400;
    public $code = '63';
	public $message = "Can't restore";

	public function __construct($entityName, $id) {
		$this->message = "{$this->message} {$entityName}({$id})";
		parent::__construct();
	}
}