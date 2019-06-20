<?php
/**
 * User: kazak
 * Email: mk@altrecipe.com
 * Date: 2019-04-22
 * Time: 17:33
 */

namespace App\Response;


use ArHelpers\Response\BaseResponse;

class DeletedResponse extends BaseResponse {
	public $code = 202;
	public $message = "successfully deleted";

	public function __construct($entityName) {
		$this->message = $entityName. " ". $this->message;
	}
}
