<?php

namespace arbo_gestion\traits;

trait singleton {
	private static $instence = null;
	private function __construct() {}

	public static function instence() {
		if(is_null(self::$instence)) {
			$class = __CLASS__;
			self::$instence = new $class();
		}
		return self::$instence;
	}
}