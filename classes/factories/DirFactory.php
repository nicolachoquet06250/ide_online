<?php

class DirFactory {
	use factory;
	public function arboressence($path = null, $file = null) {
	    $dir = new Dir();
	    $dir->path('.'.str_replace('/'.basename($path), '', $path))
            ->name(basename($path));
	    return $dir->get_arbo();
    }
}