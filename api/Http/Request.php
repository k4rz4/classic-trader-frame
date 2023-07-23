<?php
namespace App\ClassicTrader\Http;

class Request implements IRequest
{
  function __construct()
  {
    $this->bootstrapSelf();
  }

  private function bootstrapSelf()
  {
    foreach($_SERVER as $key => $value) {
      $this->{$this->toCamelCase($key)} = $value;
    }
  }

  private function toCamelCase($string)
  {
    $result = strtolower($string);

    preg_match_all('/_[a-z]/', $result, $matches);
    foreach($matches[0] as $match) {
      $c = str_replace('_', '', strtoupper($match));
      $result = str_replace($match, $c, $result);
    }
    return $result;
  }

  public function getBody(){
    switch($this->requestMethod) {
        case "POST":
            $body = array();
            $json = file_get_contents('php://input');
            $obj = json_decode($json);
            $body = $obj;
            return $body;
        default:
            return;
    }
  }
}

