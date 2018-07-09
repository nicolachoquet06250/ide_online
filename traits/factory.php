<?php

trait factory {
	use singleton;

	public static function instenciate($path) {
		$class = str_replace('Factory', '', __CLASS__);
		return (new $class())->name(basename($path))
						   ->path(str_replace('/'.basename($path), '', $path));
	}
}