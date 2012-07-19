<?php
namespace Ddnet\FoursquareBundle\Curl\Manager;

class CurlManager {
  private $key;
  private $Curl;

  public function __construct($key) {
    $this->key = $key;
    $this->Curl = Curl::getInstance();
  }

  public function __get($name) {
    $responses = $this->Curl->getResult($this->key);
    return isset($responses[$name]) ? $responses[$name] : null;
  }

  public function __isset($name) {
    $val = self::__get($name);
    return empty($val);
  }
}

/*
 * Credits:
 *  - (1) Alistair pointed out that curl_multi_add_handle can return CURLM_CALL_MULTI_PERFORM on success.
 */