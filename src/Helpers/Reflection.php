<?php
/**
 * User: kazak
 * Email: mk@altrecipe.com
 * Date: 2019-04-30
 * Time: 13:03
 */

namespace ArHelpers\Helpers;


class Reflection {
	public static function modelName($object) {
		$className = get_class($object);
		$expl = explode('\\', $className);
		return $expl[count($expl)-1];
	}
}