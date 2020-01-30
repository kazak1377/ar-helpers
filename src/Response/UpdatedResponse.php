<?php
/**
 * User: kazak
 * Email: mk@altrecipe.com
 * Date: 2019-04-29
 * Time: 17:24
 */

namespace ArHelpers\Response;

class UpdatedResponse extends BaseResponse {
	public $code = 200;
	public $message = "successfully updated";

	public function __construct($entityName, $entityId, $entityData = null) {
		$this->message =
			$entityName . "(" . $entityId . ") " . $this->message;
		$this->data = $entityData;
	}
}