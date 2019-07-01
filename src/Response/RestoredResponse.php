<?php
/**
 * User: kazak
 * Email: mk@altrecipe.com
 * Date: 2019-07-01
 * Time: 14:38
 */

namespace ArHelpers\Response;


class RestoredResponse extends BaseResponse {
    public $code = 200;
    public $message = "successfully restored";

    public function __construct($class, $id) {
        $this->message = "{$class}({$id}) {$this->message}";
    }
}