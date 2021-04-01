<?php
/**
 * System utility trait
 *
 * @author Serhii Shkrabak
 * @package Library\Shared
 */
namespace Library;
trait Shared
{
	protected function getVar(String $name, String $type = 'p'):string|null {
		$source = null;
		$var = null;
		switch ($type) {
			case 'p':
				$source = &$_POST;
			break;
			case 'g':
				$source = &$_GET;
			case 'r':
				$source = &$_REQUEST;
			break;
			case 'c':
				$source = &$_COOKIE;
			break;
			case 'e':
				$source = &$_SERVER;
			break;
			case 'f':
				$source = &$_FILES;
			break;
			case 'pc':
				if (isset($_POST[$name]))
					$var = $_POST[$name];
				else
					if (isset($_COOKIE[$name]))
						$var = $_COOKIE[$name];
			break;
			case 'i':
				$var = 'VAR_INTERNAL';
			break;
			default:
				throw new \Exception('INTERNAL_ERROR');
		}
		if ($var === null && isset($source[$name]))
			$var = $source[$name];
		return $var;
	}
}