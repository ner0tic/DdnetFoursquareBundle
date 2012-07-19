<?php

namespace Ddnet\FoursquareBundle\Entity;

use Ddnet\FoursquareBundle\Entity\User as fsUSer;

class Photo {

  /**
   *
   * @var string $id 
   */
  protected $id;
  public function getId() { return $this->id; }
  public function setId($id) { 
    $this->id = $id; 
    return $this; 
  }

  /**
   * @var integer $createdAt 
   */
  protected $createdAt;
  public function getCreatedAt() { return $this->createdAt; }
  public function setCreatedAt($createdAt) {
    $this->createdAt = $createdAt;
    return $this;    
  }
  
  protected $prefix;
  public function getPrefix() { return $this->prefix; }
  public function setPrefix($prefix) {
    $this->prefix = $prefix;
    return $this;
  }
  
  protected $suffix;
  public function getSuffix() { return $this->suffix; }
  public function setSuffix($suffix) {
    $this->suffix = $suffix;
    return $this;
  }
  
  protected $width;
  public function getWidth() { return $this->width; }
  public function setWidth($w) {
    $this->width = $w;
    return $this;
  }
  
  protected $height;
  public function getHeight() { return $this->height; }
  public function setHeight($h) {
    $this->height = $h;
    return $this;
  }
 
  protected $user;
  public function getUser() { return $this->user; }
  public function setUser($user) {
    if($user instanceof fsUser) $this->user = $user;
    elseif(is_array($user)) {
      $this->user = new fsUser();
      $this->user->fromArray($user);
    }
    else throw new FoursquareException('User should be an array or of type Ddnet\FoursquareBundle\Entity\User');
    return $this;
  }      
  
  protected $visibility;
  public function getVisibility() { return $this->visibility; }
  public function setVisibility($v) {
    $this->visibility = $v;
    return $this;
  }
}

?>