<?php

namespace Ddnet\FoursquareBundle\Entity;
use Ddnet\FoursquareBundle\Entity\User as fsUser;
use Ddnet\FoursquareBundle\Entity\Venue as fsVenue;

class Checkin {

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
  
  /**
   *
   * @var string $type
   */
  protected $type = 'checkin';
  public function getType() { return $type; }
  public function setType($type) {
    $this->type = $type;
    return $this;
  }
  
  /**
   *
   * @var string $visibility
   */
  protected $visibility = 'public';
  public function getVisibility() { return $this->visibility; }
  public function setVisibility($visibility) {
    $this->visibility = $visibility;
    return $this;
  }
  
  /**
   *
   * @var string $shout
   */
  protected $shout;
  public function getShout() { return $this->shout; }
  public function setShout($shout) {
    $this->shout = $shout;
    return $this;
  }
  
  /**
   *
   * @var integer $timezoneOffset
   */
  protected $timezoneOffset;
  public function getTimezoneOffset() { return $this->timezoneOffset; }
  public function setTimezoneOffset($offset) {
    $this->timezoneOffset = $offset;
    return $this;
  }
  
  /**
   *
   * @var Ddnet\FoursquareBundle\Entity\User $user
   */
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
  
  /**
   *
   * @var array $source
   */
  protected $source = array(
      'name'    =>  '',
      'url'     =>  ''
      );
  public function getSource($fmt='array') {
    switch($fmt) {
      case 'link':
        return '<a href="'.$this->source['url'].'">'.$this->source['name'].'</a>';
        break;
      default:
        return $this->source;
        break;
    }
  }
  public function setSource($source) {
    if(!is_array($source))
      throw new FoursquareException('Source must be an array. {name,url}');
    $this->source = $source;
    return $this;
  }
  
  /**
   *
   * @var array $photos
   */
  protected $photos = array();
  public function getPhotos() { return $this->photos; }
  public function setPhotos($photos) {
    if($photos instanceof fsPhoto) $this->photos = array($photos);
    elseif(is_array($photos)) {
      $this->photos = $photos;
    }
    else  throw new FoursquareException('Photo should be an array of Photo Entities or a single entity of  type Ddnet\FoursquareBundle\Entity\Photo');
    return $this;
  }
  
  /**
   *
   * @var array $likes
   */
  protected $likes = array(
      'count'   =>  0,
      'groups'  =>  array()
      );
  public function getLikes($count=true) { 
    switch($count) {
      case false:
        return $this->likes;
        break;
      default:
        return $this->likes['count'];
        break;
    }
  }
  public function setLikes($likes) {
    $this->likes = $likes;
    return $this;
  }
  
  /**
   *
   * @var boolean $like
   */
  protected $like = false;
  public function getLike() { return $this->like; }
  public function setLike($like) {
    $this->like = $like;
    return $this;
  }
  
  /**
   *
   * @var array $score
   */
  protected $score = array(
      'scores'    => array(
          'points'    =>  0,
          'icon'      =>  '',
          'message'   =>  ''
          ),
      'total'     =>  0
      );
  public function getScore($points = true) {
    switch($points) {
      case false:
        return $this->score;
        break;
      default:
        return $this->score['points'];
        break;
    }
  }
  public function setScore($score) {
    $this->score = $score;
    return $this;
  }
  
  public function fromArray($arr) {
    if(isset($arr['id'])) $this->setId($arr['id']);
    if(isset($arr['createdAt'])) $this->setCreatedAt($arr['createdAt']);
    if(isset($arr['type'])) $this->setType($arr['type']);
    if(isset($arr['visibility'])) $this->setVisibility($arr['visibility']);
    if(isset($arr['timezoneOffset'])) $this->setTimezoneOffset($arr['timezoneOffset']);
    if(isset($arr['shout'])) $this->setShout($arr['shout']);
    if(isset($arr['user'])) $this->setUser($arr['user']);
    if(isset($arr['venue'])) $this->setVenue($arr['venue']);
    if(isset($arr['source'])) $this->setSource($arr['source']);
    if(isset($arr['likes'])) $this->setLikes($arr['likes']);
    if(isset($arr['photos'])) $this->setPhotos($arr['photos']);
    if(isset($arr['like'])) $this->setLike($arr['like']);
    if(isset($arr['score'])) $this->setScore($arr['score']);
    return $this;
  }
}

?>