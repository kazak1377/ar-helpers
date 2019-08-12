<?php
/**
 * User: kazak
 * Email: mk@altrecipe.com
 * Date: 2019-06-21
 * Time: 13:00
 */

namespace ArHelpers\Errors;


use ArHelpers\Error\BaseError;
use Throwable;

class UnhandledExceptionError extends BaseError {
    public $httpCode = 500;
    public $code = '65';
    public $message = 'Unhandled exception';

    public function __construct(Throwable $e) {
        $this->description = [];
        $this->description[] = "Message -- ".$e->getMessage();
        $this->description[] = "File -- ".$e->getFile();
        $this->description[] = "Line -- ".$e->getLine();
        $this->description[] = "Code -- ".$e->getCode();
        $this->description[] = "Trace -- ".$e->getTraceAsString();
        parent::__construct();
    }
}