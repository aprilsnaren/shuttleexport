<?php
/**
 * Abstract dump file: provides common interface for writing
 * data to dump files. 
 */

namespace aprilsnaren\shuttleexport; 

use aprilsnaren\shuttleexport\Shuttle_Dump_File_Gzip;
use aprilsnaren\shuttleexport\Shuttle_Dump_File_Plaintext;

abstract class Shuttle_Dump_File {
	/**
	 * File Handle
	 */
	protected $fh;

	/**
	 * Location of the dump file on the disk
	 */
	protected $file_location;

	abstract function write($string);
	abstract function end();

	static function create($filename) {
		if (self::is_gzip($filename)) {
			return new Shuttle_Dump_File_Gzip($filename);
		}
		return new Shuttle_Dump_File_Plaintext($filename);
	}
	function __construct($file) {
		$this->file_location = $file;
		$this->fh = $this->open();

		if (!$this->fh) {
			throw new Shuttle_Exception("Couldn't create gz file");
		}
	}

	public static function is_gzip($filename) {
		return preg_match('~gz$~i', $filename);
	}	
}