<?php
namespace Ddnet\FoursquareBundle\Exception;
use \Exception;

class FoursquareException extends Exception {
  public static function raise($response, $debug) {
    $message = $response->data;
    switch($response->code) {
      case 400:
        throw new FoursquareBadRequestException($message, $response->code);
      case 401:
        throw new FoursquareNotAuthorizedException($message, $response->code);
      case 403:
        throw new FoursquareForbiddenException($message, $response->code);
      case 404:
        throw new FoursquareNotFoundException($message, $response->code);
      default:
        throw new FoursquareException($message, $response->code);
    }
  }
}