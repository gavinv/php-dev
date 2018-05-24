<?php

class Input {
  /**
  * Check if a given value was passed in the request
  *
  * @param string $key index to look for in request
  * @return boolean whether value exists in $_POST or $_GET
  */
  public static function has($key) {
    if (isset($_REQUEST[$key])) {
      return true;
    } else {
      return false;
    }
  }
  public static function isPost() {
    return !empty($_POST);
  }
  
  /**
  * Get a requested value from either $_POST or $_GET
  *
  * @param string $key index to look for in index
  * @param mixed $default default value to return if key not found
  * @return mixed value passed in request
  */
  public static function get($key, $default = null) {
    return self::has($key) ? $_REQUEST[$key] : $default;
  }
  
  public static function getString($key, $min = 1, $max = 30) {
    $input = self::get($key);
    if (!is_string($key) && !is_numeric($min) && !is_numeric($max)) {
      throw new InvalidArgumentException("$key must be a string and/or $min/$max must be a number!");
    }
    if (!is_string($input)) {
      throw new Exception("The value for $key must be a string!");
    } 
    if (strlen($input) < $min && strlen($input) > $max){
      throw new LengthException("Input must be between $min and $max characters!");
    }
    return trim(self::get($key));
  }
  
  public static function getNumber($key, $min = 1, $max = 8) {
    $input = self::get($key);
    if (!is_string($key) && !is_numeric($min) && !is_numeric($max)) {
      throw new InvalidArgumentException("$key must be a string and/or $min/$max must be a number!");
    }
    if (!is_numeric($input)) {
      throw new Exception("The value for $key must be a number!");
    }
    if ($input < $min || $input > $max) {
      throw new RangeException("$key must be between $min and $max characters!");
    }
    return floatval($input);
  }
  
  public static function getDate($key) {
    $input = self::get($key);
    if (!strtotime($input)) {
      throw new Exception("The value for $key must be a date!");
    }
    if ($input < $min || $input > $max) {
      throw new RangeException("$key must be between $min and $max characters!");
    }
    return new DateTime($input);
  }

  private function __construct() {}
}