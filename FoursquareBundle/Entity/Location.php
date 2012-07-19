<?php

namespace Ddnet\FoursquareBundle\Entity;

use Ddnet\FoursquareBundle\Entity\Venue as fsVenue;

class Location {

  /**
   *
   * @var Ddnet\FoursquareBundle\Entity\Venue $venue
   */
  protected $venue;
  public function getVenue() { return $this->venue; }
  public function setVenue($venue) {
    if($venue instanceof fsVenue) $this->venue = $venue;
    elseif(is_array($venue)) {
      $this->venue = new fsVenue();
      $this->venue->fromArray($venue);
    }
    else  throw new FoursquareException('Venue should be an array or of type Ddnet\FoursquareBundle\Entity\Venue');
    return $this;
  }

  protected $address;
  public function getAddress() { return $this->address; }
  public function setAddress($address) {
    $this->address = $address;
    return $this;
  }
  
  protected $crossStreet;
  public function getCrossStreet() { return $this->crossStreet; }
  public function setCrossStreet($cstreet) {
    $this->crossStreet = $cstreet;
    return $this;
  }
  
  protected $lat;
  public function getLat() { return $this->lat; }
  public function getLatitude() { return $this->getLat(); }
  public function setLat($lat) {
    $this->lat = $lat;
    return $this;
  }
  public function setLatitude($lat) { return $this->setLat($lat); }
  
  protected $lng;
  public function getLng() { return $this->lng; }
  public function getLongitude() { return $this->getLng(); }
  public function setLng($lng) {
    $this->lng = $lng;
    return $this;
  }
  public function setLongitude($lng) { return $this->setLng($lng); }
  
  protected $postalCode;
  public function getPostalCode() { return $this->postalCode; }
  public function setPostalCode($pc) {
    $this->postalCode = $pc;
    return $this;
  }
  
  protected $city;
  public function getCity() { return $this->city; }
  public function setCity($city) {
    $this->city = $city;
    return $this;
  }
  
  protected $zone;
  public function getZone() { return $this->zone; }
  public function getState() { return $this->zone; }
  public function setZone($zone) {
    $this->zone = $zone;
    return $this;      
  }
  public function setState($state) { return $this->setZone($state); }
    
  protected $country;
  public function getCountry() { return $this->country; }
  public function setCountry($country) {
    $this->country = $country;
    return $this;
  }
  
  protected $cc;
  public function getCC() { return $this->cc; }
  public function getCountryCode() { return $this->cc; }
  public function getCode() { return $this->cc; }
  public function setCC($cc) {
    $this->cc = $cc;
    return $this;
  }
  public function setCountryCode($code) { return $this->setCC($code); }
  public function setCode($code) { return $this->setCode(); }
  
  public function fromArray($arr) {
    if(isset($arr['address'])) $this->setAddress($arr['address']);
    if(isset($arr['cc'])) $this->setCC($arr['cc']);
    if(isset($arr['city'])) $this->setCity($arr['city']);
    if(isset($arr['country'])) $this->setCountry($arr['country']);
    if(isset($arr['crossStreet'])) $this->setCrossStreet($arr['crossStreet']);
    if(isset($arr['lat'])) $this->setLat($arr['lat']);
    if(isset($arr['lng'])) $this->setLng($arr['lng']);
    if(isset($arr['postalCode'])) $this->setPostalCode($arr['postalCode']);
    if(isset($arr['state'])) $this->setState($arr['state']);
    if(isset($arr['venue'])) $this->setVenue($arr['venue']);
    return $this;
  }
}

?>