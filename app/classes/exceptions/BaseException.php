<?php

namespace App\exceptions;

use Exception;

class BaseException extends Exception {
	public function getDebugInfo() {
	  echo 'Message: ' . $this->getMessage() . '<br>';
	  echo 'File: ' . $this->getFile() . '<br>';
	  echo 'Line: ' . $this->getLine() . '<br>';
	  echo 'Trace: ' . $this->getTraceAsString() . '<br>';
	}
}