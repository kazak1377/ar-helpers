<?php
/**
 * User: kazak
 * Email: mk@altrecipe.com
 * Date: 2019-05-10
 * Time: 16:46
 */

namespace ArHelpers\Helpers;


use ArHelpers\Errors\ValidationError;
use Illuminate\Contracts\Validation\Validator;

class ValidationHelper {
	/** @var ValidationError|null  */
	public $error = NULL;
	public $hasErrors = false;
	public $validator;

	/**
	 * ValidationHelper constructor.
	 *
	 * @param $entityName
	 * @param Validator|null $validator
	 */
	public function __construct($entityName, $validator = NULL) {
		if (!is_null($validator) && $validator->fails()) {
			$this->validator = $validator;
			$this->hasErrors = true;
			$this->error = new ValidationError($entityName);
            $this->error->description = self::formatingErrors($validator->errors()->toArray());
		}
	}

    private static function formatingErrors($errorMessages) {
        $resultErrors = [];
        foreach ($errorMessages as $key => $errorMessage) {
            $resultErrors = array_merge($errorMessage, $resultErrors);
        }
        return $resultErrors;
    }
}
