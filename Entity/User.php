<?php

namespace Ddnet\FoursquareBundle\Entity;

//use Ddnet\FoursquareBundle\Entity\List as fsList;
use Ddnet\FoursquareBundle\Entity\Tip as fsTip;
use Ddnet\FoursquareBundle\Entity\Photo as fsPhoto;

class User {

  protected $id;
  public function getId() { return $this->id; }
  public function setId($id) {
    $this->id = $id;
    return $this;
  }

  protected $firstName;
  public function getFirstName() { return $this->firstName; }
  public function setFirstName($firstName) {
    $this->firstName = $firstName;
    return $this;
  }
  
  protected $lastName;
  public function getLastName() { return $this->lastName; }
  public function setLastName($lastName) {
    $this->lastName = $lastName;
    return $this;
  }
  
  protected $relationship = 'self';
  public function getRelationship() { return $this->relationship; }
  public function setRelationship($r) {
    $this->relationship = $r;
    return $this;
  }
  
  protected $friends = array();
  public function getFriends() { return $this->friends; }
  public function setFriends($friends) {
    $this->friends = $friends;
    return $this;
  }
  
  protected $type = "user";
  public function getType() { return $this->type; }
  public function setType($type) {
    $this->type = $type;
    return $this;
  }
  
  protected $lists = array();
  public function getLists() { return $this->lists; }
  public function setLists($lists) {
    if($lists instanceof \Self) $this->lists = array($lists);
    elseif(is_array($lists)) {
      $this->lists = $lists;
    }
    else  throw new FoursquareException('List should be an array of List Entities or a single entity of type Ddnet\FoursquareBundle\Entity\List');
    return $this;
  }
  public function getList() {
    foreach($list as $lists) {
      if($list->getPrimary()) return $list;
    }
    return $this->lists[0];
  }
  public function addList($list) {   
    if($list instanceof \Self) {
      $this->lists[] = $list;
      return $this;
    }
    elseif(is_array($list)) {
      $c = new \Self();
      $c->fromArray($list);
      return $this;
    }
    else  throw new FoursquareException('List should be an array or a single entity of type Ddnet\FoursquareBundle\Entity\List');
  }    
  
  protected $tips = array();
  public function getTips() { return $this->tips; }
  public function setTips($tips) {
    if($categories instanceof fsTip) $this->tips = array($tips);
    elseif(is_array($tips)) {
      $this->tips = $tips;
    }
    else  throw new FoursquareException('Tip should be an array of Tip Entities or a single entity of type Ddnet\FoursquareBundle\Entity\Tip');
    return $this;
  }
  public function getTip() {
    foreach($tip as $tips) {
      if($tip->getPrimary()) return $tip;
    }
    return $this->tips[0];
  }
  public function addTip($tip) {   
    if($tip instanceof fsTip) {
      $this->tips[] = $tip;
      return $this;
    }
    elseif(is_array($tip)) {
      $t = new fsTip();
      $t->fromArray($tip);
      $this->tips[] = $tip;
      return $this;
    }
    else  throw new FoursquareException('Tip should be an array or a single entity of type Ddnet\FoursquareBundle\Entity\Tip');
  } 
  
  protected $gender = 'unisex';
  public function getGender() { return $this->gender; }
  public function setGender($sex) {
    $this->gender = $sex;
    return $this;
  }
  
  protected $homeCity = 'Margaritaville';
  public function getHomeCity() { return $this->homeCity; }
  public function setHomeCity($city) {
    $this->homeCity = $city;
    return $this;
  }
  
  protected $bio;
  public function getBio() { return $this->bio; }
  public function setBio($bio) {
    $this->bio = $bio;
    return $this;
  }
  
  protected $contact = array();
  public function getContact() { return $this->contact; }
  public function setContact($contact) {
    $this->contact = array_merge($this->contact, $contact);
    return $this;
  }
  
  protected $pings = false;
  public function getPings() { return $this->pings; }
  public function setPings($pings) {
    $this->pings = $pings;
    return $this;
  }
  
  protected $badges = array();
  public function getBadges() { return $this->badges; }
  public function setBadges($badges) {
    $this->badges = $badges;
    return $this;
  }
  
  protected $mayorships = array();
  public function getMayorships() { return $this->mayorships; }
  public function setMayorships($mayorships) {
    $this->mayorships = $mayorships;
    return $this;
  }
  
  protected $checkins = array();
  public function getCheckins() { return $This->checkins; }
  public function setCheckins($checkins) {
    $this->checkins = $checkins;
    return $this;
  }
  
  protected $following = array();
  public function getFollowing() { return $This->following; }
  public function setFollowing($follow) {
    $this->following = $follow;
    return $this;
  }
  
  protected $requests;
  public function getRequests() { return $this->requests; }
  public function setRequests($r) { 
    $this->requests = $r;
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
  
  
  protected $scores = array();
  public function getScores() { return $this->scores; }
  public function setScores($scores) { 
    $this->scores = $score;
    return $this;
  }
  
  protected $referralId;
  public function getReferralId() { return $this->referralId; }
  public function setReferralId($id) {
    $this->referralId = $id;
    return $this;
  }  
  
}

?>