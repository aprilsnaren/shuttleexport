<?php
namespace aprilsnaren\shuttleexport;

use aprilsnaren\shuttleexport\Shuttle_DBConn_Mysqli;

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
		return new Shuttle_DBConn_Mysqli($options);
	}
}