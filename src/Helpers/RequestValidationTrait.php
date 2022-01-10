<?php


namespace ArHelpers\Helpers;


use ArHelpers\Errors\ValidationError;
use ArHelpers\Response\BaseResponse;
use ArHelpers\Response\ErrorResponse;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

trait RequestValidationTrait {
    /**
     * @param string $eName entity name
     * @param array $rParams required params
     * @param string $rClass response class
     * @return BaseResponse
     */
    protected function getRequestValidationError($eName, $rParams, $rClass) {
        $error = new ValidationError($eName);
        $desc = [
            "message" => "All params are required",
            "required_params" => $rParams,
            "your_request" => Request::input()
        ];
        $error->setDescription($desc);
        /** @var BaseResponse $resp */
        $resp = new $rClass();
        return $resp
            ->setError($error);
    }

    protected function requestIsValid($requiredFields) {
        foreach ($requiredFields as $param) {
            if (empty(Request::input($param))) {
                return false;
            }
        }
        return true;
    }

    protected function validateRequest($rules, $messages = [], $fields = null) {
        $fieldsForValidation = $fields ? $fields : Request::input();
        $validator = Validator::make($fieldsForValidation, $rules, $messages);
        $vhelper = new ValidationHelper('', $validator);
        if ($vhelper->hasErrors) {
            (new ErrorResponse())
                ->setError($vhelper->error)
                ->sendAndDie();
        }
    }
}