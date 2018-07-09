<?php

namespace arbo_gestion\entities;

class File {
	protected $path = '';
	protected $name = '';
	protected $vars = [];

	public static function instence() {
	    return new File();
    }

	public function read() {
		return file_get_contents("{$this->path}/{$this->name}");
	}
	public function write($code) {
		file_put_contents("{$this->path}/{$this->name}", $code);
	}
	public function is_one() {
		return is_file("{$this->path}/{$this->name}");
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
	public function vars(array $vars = null) {
		if(is_null($vars)) {
			return $this->vars;
		}
		foreach ($vars as $var => $value) {
			$this->vars[$var] = $value;
		}
		return $this;
	}
	public function _var(string $var, $value = null) {
		if(is_null($value)) {
			return $this->vars[$var];
		}
		$this->vars[$var] = $value;
		return $this;
	}

	public function create() {
		$dirs = explode('/', "{$this->path}");
		foreach ($dirs as $dir) {
			/**
			 * @var Dir $directory
			 */
			$directory = DirFactory::instenciate("{$this->path}");
			if($dir !== '') {
				$directory->create();
			}
		}
		if(!is_file("{$this->path}/{$this->name}")) {
			touch("{$this->path}/{$this->name}");
		}
	}
	public function delete($code) {
		$file_content = $this->read();
		$file_content = str_replace($code, '', $file_content);
		$this->write($file_content);
	}
	public function update($old_code, $new_code) {
		$file_content = $this->read();
		$file_content = str_replace($old_code, $new_code, $file_content);
		$this->write($file_content);
	}
	public function append($code) {
		$file_content = $this->read();
		$file_content .= $code;
		$this->write($file_content);
	}

}