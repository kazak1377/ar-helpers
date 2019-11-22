<?php


namespace App\Errors;


use ArHelpers\Error\BaseError;

class ExternalServiceError extends BaseError {
    public $code = "67";

    public function __construct($serviceName) {
        $this->message = "Error on {$serviceName} service";
        return parent::__construct();
    }
}
