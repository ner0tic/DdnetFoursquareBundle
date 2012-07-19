<?php

namespace Ddnet\FoursquareBundle\Entity;

use Ddnet\FoursquareBundle\Entity\Location as fsLocation;
use Ddnet\FoursquareBundle\Entity\Category as fsCategory;
use Ddnet\FoursquareBundle\Entity\Tip as fsTip;

class Venue {

  protected $id;
  public function getId() { return $this->id; }
  public function setId($id) {
    $this->id = $id;
    return $this;
  }

  protected $name;
  public function getName() { return $this->name; }
  public function setName($name) {
    $this->name = $name;
    return $this;
  }
  
  protected $contact = array (
      'phone'           =>  '',
      'formattedPhone'  =>  ''
      );
  public function getContact($formatted = true) {
    if($formatted && isset($this->contact['formattedPhone'])) return $this->contact['formattedPhone'];
    else  return $this->contact['phone'];    
  }
  public function setContact($contact) {
    if(!is_array($contact) && (strstr($contact, '(') || strstr($contact, '-')))
      $this->contact['formattedPhone'] = $contact;
    elseif(!is_array($contact))
      $this->contact['phone'] = $contact;
    else
      $this->contact = $contact;
  }
  
  protected $location;
  public function getLocation() { return $this->location; }
  public function setLocation($location) {
    if($location instanceof fsLocation) $this->location = array($location);
    elseif(is_array($location)) {
      $this->location = new fsLocation();
      $this->location->fromArray($location);
    }
    else  throw new FoursquareException('Location should be of type Ddnet\FoursquareBundle\Entity\Location');
    return $this;
  }    
  
  protected $categories = array();
  public function getCategories() { return $this->categories; }
  public function setCategories($categories) {
    if($categories instanceof fsCategory) $this->categories = array($categories);
    elseif(is_array($categories)) {
      $this->categories = $categories;
    }
    else  throw new FoursquareException('Category should be an array of Category Entities or a single entity of type Ddnet\FoursquareBundle\Entity\Category');
    return $this;
  }
  
  protected $primaryCategory;
  public function getPrimaryCategory() {
    if(is_null($this->primaryCategory)) {
      foreach($this->categories as $cat) {
        if($cat->isPrimary()) {
          $this->setPrimaryCategory($cat);
          return $cat;
        }
      }
      $this->setPrimaryCategory($this->$categories[0]);
      return $this->categories[0];
    }
    return $this->primaryCategory;
  }
  public function addPrimaryCategory($category,$addIfNone=true) {
    foreach($this->categories as $cat) {
      if($cat == $category) {
        $cat->setPrimary(true);
        $this->primaryCategory = $cat;
      }
    }    
    if($addIfNone) {
      $category->setPrimary(true);
      $this->addCategory($category);
      $this->primaryCategory = $category;
    }
    return $this;
  }
  public function addCategory($category) {   
    if($category instanceof fsCategory ) {
      $this->categories[] = $category;
      return $this;
    }
    elseif(is_array($category)) {
      $c = new fsCategory();
      $c->fromArray($category);
      return $this;
    }
    else  throw new FoursquareException('Category should be an array or a single entity of type Ddnet\FoursquareBundle\Entity\Category');
  }    
  
  protected $verified = false;
  public function isVerified() { return $this->verified; }
  public function setVerified($verified) {
    $this->verified = $verified;
    return $this;
  }
  
  protected $stats = array(
      'checkinsCount'   =>  0,
      'usersCount'      => 0,
      'tipCount'        =>  0
      );
  public function getStats() { return $this->stats; }
  public function setStats($stats) {
    if(!is_array($stats))
      throw new FoursquareException('stats must be an array');
    $this->stats = array_merge($this->stats,$stats);
    return $this;
  }
  
  protected $url;
  public function getUrl() { return $this->url; }
  public function setUrl($url) {
    $this->url = $url;
    return $this;
  }
  
  protected $likes = array(
      'count'   =>  0,
      'groups'  =>  ''
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
  
  protected $specials = array(
      'count'   => 0
      );
  public function getSpecials($count=true) { 
    switch($count) {
      case false:
        return $this->specials;
        break;
      default:
        return $this->specials['count'];
        break;
    }
  }
  public function setSpecials($specials) {
    $this->specials = $specials;
    return $this;
  }  
  
  protected $createdAt;
  public function getCreatedAt() { return $this->createdAt; }
  public function setCreatedAt($createdAt) {
    $this->createdAt = $createdAt;
    return $this;
  }
  
  protected $mayor  = array(
      'count'   =>  0,
      'user'    =>  ''
      );
  public function getMayor($count=false) {
    if($count)  return $this->mayor['count'];
    return $this->mayor['user'];
  }
  public function setMayor($user=null,$count=0) {
    if(!is_null($user) && ($user instanceof fsUser)) $this->mayor['user'] = $user;
    elseif(!is_null($user) && is_array($user)) {
      $u = new fsUser();
      $u->fromArray($user);
    }
    $this->mayor['count'] = $count;
    return $this;
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
  
  protected $tags = array();
  public function getTags() { return $this->tags; }
  public function setTags($tags) {
    $this->tags = array_merge($this->tags,$tags);
  }
  
  protected $shortUrl;
  public function getShortUrl() { return $this->shortUrl; }
  public function setShortUrl($sUrl) {
    $this->shortUrl = $sUrl;
    return $this;
  }
  
  protected $timeZone = "America/New_York";
  public function getTimeZone() { return $this->timeZone; }
  public function setTimeZone($tz) {
    $this->timeZone = $tz;
    return $this;
  }
  
  protected $listed = array();
  public function getListed() { return $this->listed; }
  public function setListed($listed) {
    $this->listed = array_merge($this->listed, $listed);
    return $this;
  }
  
  protected $phrases = array();
  public function getPhrases() { return $this->getPhrases; }
  public function setPhrases($phrases) {
    $this->phrases = array_merge($this->phrases, $phrases);
    return $this;
  }
  
  public function fromArray($arr) {
    if(isset($arr['categories'])) $this->SetCategories($arr['categories']);
    if(isset($arr['url'])) $this->SetUrl($arr['url']);
    if(isset($arr['contact'])) $this->SetContact($arr['contact']);
    if(isset($arr['createdAt'])) $this->SetCreatedAt($arr['createdAt']);
    if(isset($arr['id'])) $this->SetId($arr['id']);
    if(isset($arr['likes'])) $this->SetLikes($arr['likes']);
    if(isset($arr['listed'])) $this->SetListed($arr['listed']);
    if(isset($arr['location'])) $this->SetLocation($arr['location']);
    if(isset($arr['mayor'])) $this->SetMayor($arr['mayor']);
    if(isset($arr['name'])) $this->SetName($arr['name']);
    if(isset($arr['phrases'])) $this->SetPhrases($arr['phrases']);
    if(isset($arr['shortUrl'])) $this->SetShortUrl($arr['shortUrl']);
    if(isset($arr['specials'])) $this->SetSpecials($arr['specials']);
    if(isset($arr['stats'])) $this->SetStats($arr['stats']);
    if(isset($arr['tags'])) $this->SetTags($arr['tags']);
    if(isset($arr['timeZone'])) $this->SetTimeZone($arr['timeZone']);
    if(isset($arr['tips']))     $this->SetTips($arr['tips']);
    if(isset($arr['verified'])) $this->SetVerified($arr['verified']);
    return $this;
  }
}

?>