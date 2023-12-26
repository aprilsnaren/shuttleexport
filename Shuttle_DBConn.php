<?php
namespace aprilsnaren\shuttleexport;

class Shuttle_DBConn {
	public $host;
	public $username;
	public $password;
	public $name;

	protected $connection;

	function __construct($options) {
		$this->host = $options['host'];
		if (empty($this->host)) {
			$this->host = '127.0.0.1';
		}
		$this->username = $options['username'];
		$this->password = $options['password'];
		$this->name = $options['db_name'];
	}

	static function create($options) {
		if (class_exists('mysqli')) {
			$class_name = "Shuttle_DBConn_Mysqli";
		} else {
			$class_name = "Shuttle_DBConn_Mysql";
		}

		return new $class_name($options);
	}
}