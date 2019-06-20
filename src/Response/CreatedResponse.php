<?php
/**
 * User: kazak
 * Email: mk@altrecipe.com
 * Date: 2019-04-22
 * Time: 17:33
 */

namespace App\Response;


use ArHelpers\Response\BaseResponse;

class CreatedResponse extends BaseResponse {
	public $code = 201;
	public $message = "successfully created";

	public function __construct($entityName) {
		$this->message = $entityName. " ". $this->message;
	}
}
