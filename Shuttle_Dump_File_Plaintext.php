<?php
/**
 * Plain text implementation. Uses standard file functions in PHP. 
 */

namespace aprilsnaren\shuttleexport;

class Shuttle_Dump_File_Plaintext extends Shuttle_Dump_File {
	function open() {
		return fopen($this->file_location, 'w');
	}
	function write($string) {
		return fwrite($this->fh, $string);
	}
	function end() {
		return fclose($this->fh);
	}
}