<?php
namespace aprilsnaren\shuttleexport;

class Shuttle_DBConn_Mysqli extends Shuttle_DBConn {
	function connect() {
		$this->connection = @new \MySQLi($this->host, $this->username, $this->password, $this->name);

		if ($this->connection->connect_error) {
			throw new Shuttle_Exception("Couldn't connect to the database: " . $this->connection->connect_error);
		}

		return true;
	}

	function query($q) {
		if (!$this->connection) {
			$this->connect();
		}
		$res = $this->connection->query($q);
		
		if (!$res) {
			throw new Shuttle_Exception("SQL error: " . $this->connection->error);
		}
		
		return $res;
	}

	function fetch_numeric($query) {
		return $this->fetch($query, MYSQLI_NUM);
	}

	function fetch($query, $result_type=MYSQLI_ASSOC) {
		$result = $this->query($query, $this->connection);
		$return = array();
		while ( $row = $result->fetch_array($result_type) ) {
			$return[] = $row;
		}
		return $return;
	}

	function escape($value) {
		if (is_null($value)) {
			return "NULL";
		}
		return "'" . $this->connection->real_escape_string($value) . "'";
	}

	function escape_like($search) {
		return str_replace(array('_', '%'), array('\_', '\%'), $search);
	}

	function get_var($sql) {
		$result = $this->query($sql);
		$row = $result->fetch_array($result, MYSQLI_NUM);
		return $row[0];
	}

	function fetch_row($data) {
		return $data->fetch_array(MYSQLI_ASSOC);
	}
}