<?php

namespace Ddnet\FoursquareBundle\Foursquare;
use Ddnet\FoursquareBundle\Foursquare\FoursquareBase;
use Symfony\Component\DependencyInjection\ContainerAware; 
//use Symfony\Component\DependencyInjection\ContainerInterface;

use Ddnet\FoursquareBundle\Exception\FoursquareException as Exception;
use Ddnet\FoursquareBundle\Exception\FoursquareBadRequestException as BadRequest;
use Ddnet\FoursquareBundle\Exception\FoursquareNotFoundException as NotFound;

 /**
 * Foursquare API wrapper
 *
 * @author david durost <david.durost@gmail.com>
 */
class Foursquare extends ContainerAware {
  protected static 
    $_foursquare        = false;
  protected 
    $requestTokenUrl    = 'https://foursquare.com/oauth2/authenticate',
    $accessTokenUrl     = 'https://foursquare.com/oauth2/access_token',
    $authorizeUrl       = 'https://foursquare.com/oauth2/authorize',
    $apiUrl             = 'https://api.foursquare.com';
  protected 
    $apiVersion         = 'v2',
    $isAsynchronous     = false,
    $followLocation     = false,
    $connectionTimeout  = 5,
    $requestTimeout     = 30,
    $debug              = false,
    $token              = null;
  protected 
    $container;
  
  public function setAccessToken($token) { $this->token = $token; }
  public function setTimeout($requestTimeout = null, $connectionTimeout = null) {
    if($requestTimeout !== null)
      $this->requestTimeout = floatval($requestTimeout);
    if($connectionTimeout !== null)
      $this->connectionTimeout = floatval($connectionTimeout);
  }
  public function useApiVersion($version = null) { $this->apiVersion = $version; }
  public function useAsynchronous($async = true) { $this->isAsynchronous = (bool)$async; }
  
  public function delete($endpoint, $params = null) { return $this->request('DELETE', $endpoint, $params); }
  public function get($endpoint, $params = null) { return $this->request('GET', $endpoint, $params); }
  public function post($endpoint, $params = null) { return $this->request('POST', $endpoint, $params); }

  public function __construct(ContainerInterface $container) { 
    $this->container = $container;
    $this->setAccessToken($this->container->getParameter('api_key')); }
  public static function getFoursquareInstance() {
    return new Foursquare();
  }
  public static function retrieve($endpoint, $params = null, $method = 'get') {
    $fs = new self();
    $method = strtolower($method);
    switch($method) {
      case 'get':
        return $fs->get($endpoint, $params);
        break;
      case 'post':
        return $fs->post($endpoint, $params);
        break;
      case 'delete':
        return $fs->delete($endpoint, $params);
        break;
      default:
        throw new BadRequestException('The given method is invalid.');     
    }
  }

  private function getApiUrl($endpoint) {
    if(!empty($this->apiVersion))
      return "$this->apiUrl/$this->apiVersion/$endpoint";
    else
      return "$this->apiUrl/$endpoint";
  }

  private function request($method, $endpoint, $params = null) {
    if(preg_match('#^https?://#', $endpoint))
      $url = $endpoint;
    else
      $url = $this->getApiUrl($endpoint);
    
    if($this->token)
      $params['oauth_token'] = $this->token;
    else  throw new NotFoundException('no oauth token found.');
    
    if($method === 'GET')
      $url .= is_null($params) ? '' : '?'.http_build_query($params, '', '&');
    
    $ch  = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_USERAGENT, "ddFetcher ".time());
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, $this->requestTimeout);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    
//    if(isset($_SERVER ['SERVER_ADDR']) && !empty($_SERVER['SERVER_ADDR']) && $_SERVER['SERVER_ADDR'] != '127.0.0.1')
//      curl_setopt($ch, CURLOPT_INTERFACE, $_SERVER ['SERVER_ADDR']);
    
    if($method === 'POST' && $params !== null)
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
    
    $data = curl_exec($ch);
    $meta = json_decode($data,true);
    if($meta['meta']["code"] != 200)
      throw new Exception("error encountered getting data.<br />code: ".$meta['meta']["code"]."<br />url: ".$url);
      
    return $data;
  }
}