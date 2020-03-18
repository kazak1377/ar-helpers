<?php


namespace ArHelpers\Helpers;


use ArrayAccess;
use Countable;
use Iterator;
use JsonSerializable;
use Throwable;

class ARArray implements ArrayAccess, Iterator, Countable, JsonSerializable {
    private $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function get($path) {
        $keys = explode('.', $path);
        $data = [];
        try {
            foreach ($keys as $key) {
                $data = $data[$key] ?? $this->data[$key];
            }
            if (is_array($data)) {
                $data = new ARArray($data);
            }
            return $data ?? "";
        } catch (Throwable $e) {
            ARArrayErrors::inst()->addError([
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'requestedData' => $data,
                'requestedPath' => $path
            ]);
            return "";
        }
    }

    public function has($path) {
        return !empty($this->get($path)->data) ||
            !empty($this->get($path));
    }

    public function arrayKeys($path) {
        try {
            return array_keys($this->get($path)->data);
        } catch (Throwable $e) {
            ARArrayErrors::inst()->addError([
                'message' => "Trying to get array keys on non array",
                'code' => "ARRAY KEYS ERROR",
                'requestedPath' => $path,
                'exception' => [
                    "Message" => $e->getMessage(),
                    "File" => $e->getFile(),
                    "Line" => $e->getLine(),
                    "Code" => $e->getCode()
                ]
            ]);
            return [];
        }
    }

    /**
     * Whether a offset exists
     * @link https://php.net/manual/en/arrayaccess.offsetexists.php
     *
     * @param mixed $offset <p>
     * An offset to check for.
     * </p>
     *
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     * @since 5.0.0
     */
    public function offsetExists($offset) {
        return key_exists($offset, $this->data);
    }

    /**
     * Offset to retrieve
     * @link https://php.net/manual/en/arrayaccess.offsetget.php
     *
     * @param mixed $offset <p>
     * The offset to retrieve.
     * </p>
     *
     * @return mixed Can return all value types.
     * @since 5.0.0
     */
    public function offsetGet($offset) {
        if (isset($this->data[$offset]) && is_array($this->data[$offset])) {
            return new ARArray($this->data[$offset]);
        } else {
            return $this->data[$offset] ?? $this->get($offset);
        }
    }

    /**
     * Offset to set
     * @link https://php.net/manual/en/arrayaccess.offsetset.php
     *
     * @param mixed $offset <p>
     * The offset to assign the value to.
     * </p>
     * @param mixed $value <p>
     * The value to set.
     * </p>
     *
     * @return void
     * @since 5.0.0
     */
    public function offsetSet($offset, $value) {
    }

    /**
     * Offset to unset
     * @link https://php.net/manual/en/arrayaccess.offsetunset.php
     *
     * @param mixed $offset <p>
     * The offset to unset.
     * </p>
     *
     * @return void
     * @since 5.0.0
     */
    public function offsetUnset($offset) {
    }

    /**
     * Return the current element
     * @link https://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     * @since 5.0.0
     */
    public function current() {
        return new ARArray(current($this->data));
    }

    /**
     * Move forward to next element
     * @link https://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function next() {
        next($this->data);
    }

    /**
     * Return the key of the current element
     * @link https://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     * @since 5.0.0
     */
    public function key() {
        return key($this->data);
    }

    /**
     * Checks if current position is valid
     * @link https://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     * @since 5.0.0
     */
    public function valid() {
        return null !== key($this->data);
    }

    /**
     * Rewind the Iterator to the first element
     * @link https://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function rewind() {
        reset($this->data);
    }

    public function count() {
        return count($this->data);
    }

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize() {
        return $this->data;
    }

    public function json() {
        return json_encode($this);
    }
}