<?php

namespace arbo_gestion\entities;

class Dir {
	protected $path = '';
	protected $name = '';
    protected $arbo = [];

    public static function instence() {
        return new Dir();
    }

	public function read() {
		$list = [];
		if($this->is_one()) {
			$dir = opendir("{$this->path}/{$this->name}");
			while (($file = readdir($dir)) !== false) {
				if ($file !== '.' && $file !== '..') {
					$list[] = "{$this->path}/{$this->name}/{$file}";
				}
			}
		}
		else {
			$this->write("");
		}
		return $list;
	}
	public function write() {
		if(!$this->is_one()) {
			mkdir("{$this->path}/{$this->name}", 0777, true);
		}
	}
	public function is_one() {
		return is_dir("{$this->path}/{$this->name}");
	}

	public function get_arbo($path = '') {
        $path = $path === '' ? "{$this->path}/{$this->name}" : "{$path}";
	    $dir = opendir($path);
	    while (($file = readdir($dir)) !== false) {
	        if($file !== '.' && $file !== '..') {
	            if(is_file("{$path}/{$file}")) {
	                $this->arbo[] = "{$path}/{$file}";
                }
                elseif (is_dir("{$path}/{$file}")) {
	                $this->get_arbo("{$path}/{$file}");
                }
            }
        }
        return $this->arbo;
    }

	public function path(string $path = null) {
		if(is_null($path)) {
			return $this->path;
		}
		$this->path = $path;
		return $this;
	}
	public function name(string $name = null) {
		if(is_null($name)) {
			return $this->name;
		}
		$this->name = $name;
		return $this;
	}

	public function create($directory = null) {
		$directory = !is_null($directory) ? "/{$directory}" : '';
		if(!in_array("{$this->path}/{$this->name}{$directory}", $this->read())) {
			$this->write($directory);
		}
	}
	public function update($old_name, $new_name) {

	}
	public function delete($directory = null) {
		if(!is_null($directory)) {
			$directory = "/{$directory}";
		}
		else {
			$directory = '';
		}
		rmdir("{$this->path}/{$this->name}{$directory}");
	}
	public function get() {
	    $liste = [];
	    if($this->is_one()) {
	        $dir = opendir("{$this->path}/{$this->name}");
	        while (($file = readdir($dir)) !== false) {
	            if($file !== '.' && $file !== '..') {
	                $liste[] = "{$this->path}/{$this->name}/{$file}";
                }
            }
        }
        return $liste;
    }
}