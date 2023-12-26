<?php
/**
 * Gzip implementation. Uses gz* functions. 
 */

namespace aprilsnaren\shuttleexport;

class Shuttle_Dump_File_Gzip extends Shuttle_Dump_File {
	function open() {
		return gzopen($this->file_location, 'wb9');
	}
	function write($string) {
		return gzwrite($this->fh, $string);
	}
	function end() {
		return gzclose($this->fh);
	}
}