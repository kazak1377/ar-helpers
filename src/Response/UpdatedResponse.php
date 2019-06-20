<?php
/**
 * User: kazak
 * Email: mk@altrecipe.com
 * Date: 2019-04-29
 * Time: 17:24
 */

namespace App\Response;


use ArHelpers\Response\BaseResponse;

class UpdatedResponse extends BaseResponse {
	public $code = 200;
	public $message = "successfully updated";

	public function __construct($entityName, $entityId) {
		$this->message =
			$entityName . "(" . $entityId . ") " . $this->message;
	}
}