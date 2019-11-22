<?php
/**
 * User: kazak
 * Email: mk@altrecipe.com
 * Date: 2019-04-22
 * Time: 16:54
 */

namespace ArHelpers\Error;


use Illuminate\Contracts\Container\BindingResolutionException;

abstract class BaseError implements iError {
    public $message;
    public $code;
    public $description = [];
    public $httpCode = 400;
    public $request = [];

    public function __toString() {
        return json_encode($this->toArray());
    }

    public function __construct() {
        try {
            $this->code = config(
                    'app.errorPrefix',
                    env('APP_ERROR_PREFIX', 'unset')
                ) . $this->code;
        } catch (BindingResolutionException $e) {
            $this->code = "00" . $this->code;
        }
    }

    public function toArray() {
        return [
            'code' => $this->code,
            'message' => $this->message,
            'desc' => $this->description,
            'request' => $this->request
        ];
    }

    public function setDescription($desc) {
        $this->description = $desc;
        return $this;
    }

    public function appendDescription(array $data) {
        if (is_string($this->description)) {
            $this->description = [
                'desc' => $this->description
            ];
        }
        $this->description = array_merge($this->description, $data);
        return $this;
    }

    public function setRequestBody($request) {
        $this->request = $request;
        return $this;
    }

    public function setCode($code) {
        $this->code = $code;
        return $this;
    }

    public function setMessage($message) {
        $this->message = $message;
        return $this;
    }
}
