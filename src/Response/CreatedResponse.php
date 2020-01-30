<?php
/**
 * User: kazak
 * Email: mk@altrecipe.com
 * Date: 2019-04-22
 * Time: 17:33
 */

namespace ArHelpers\Response;

class CreatedResponse extends BaseResponse {
	public $code = 201;
	public $message = "successfully created";

	public function __construct($entityName, $entityData = null) {
		$this->message = $entityName. " ". $this->message;
		$this->data = $entityData;
	}
}
