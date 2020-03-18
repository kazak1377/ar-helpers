<?php


namespace ArHelpers\Helpers;


class ARArrayErrors {
    /**
     * @var ARArrayErrors
     */
    private static $instance;
    private $errors = [];

    /**
     * gets the instance via lazy initialization (created on first usage)
     */
    public static function inst(): ARArrayErrors
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    public function addError($error) {
        $this->errors[] = $error;
    }

    public function errors() {
        return $this->errors;
    }

    public function errorsJson() {
        return json_encode($this->errors);
    }

    /**
     * is not allowed to call from outside to prevent from creating multiple instances,
     * to use the singleton, you have to obtain the instance from Singleton::getInstance() instead
     */
    private function __construct() {}

    /**
     * prevent the instance from being cloned (which would create a second instance of it)
     */
    private function __clone() {}

}