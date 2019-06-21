<?php
/**
 * User: kazak
 * Email: mk@altrecipe.com
 * Date: 2019-06-21
 * Time: 13:00
 */

namespace ArHelpers\Errors;


use ArHelpers\Error\BaseError;

class UnhandledExceptionError extends BaseError {
    public $code = '500';
    public $message = 'Unhandled exception';

    public function __construct($e) {
        $this->description = $e;
        parent::__construct();
    }
}