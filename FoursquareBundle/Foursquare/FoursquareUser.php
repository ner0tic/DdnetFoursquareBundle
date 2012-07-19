<?php
/**
 * Description of FoursquareUser
 *
 * @author ner0tic
 */
namespace Ddnet\FoursquareBundle\Foursquare;
class FoursquareUser { //extends FoursquareBase {
  protected
          $id                 = null,
          $createdAt          = null,
          $oAuthToken         = null,
          $fname              = null,
          $lname              = null,
          $homeCity           = null,
          $photo              = null,
          $gender             = null,
          $relationship       = null;
  protected
          $type               = null,
          $contact = array(
              'twitter'         =>  null,
              'phone'           =>  null,
              'formattedPhone'  =>  null
          ),
          $pings              = null,
          $mayorships         = array(),
          $tips               = array(),
          $todos              = array(),
          $photos             = array(),
          $friends            = array(),
          $followers          = null,
          $requests           = null,
          $pageInfo           = null;
  public static function createFromArray($a = array()) {
    if(sizeof($a)===0)   throw new FoursquareException('not an array');
    return new FoursquareUser($a);
  }
    
  public function __construct() { 
    $args = func_get_args();

  }    
  
  //getters
  public function getId() { return $this->id; }
  public function getFirstname() { return $this->fname; }
  public function getLastname() { return $this->lname; }
  public function getHomeCity() { return $this->homeCity; }
  public function getPhoto() { return $this->photo; }
  public function getGender() { return $this->gender; }
  public function getRelationship() { return $this->relationship; }
  public function getType() { return $this->type; }
  public function getTwitter() { return $this->contact['twitter']; }
  public function getPhone($formatted=true) { return $formatted ? $this->contact['formattedPhone'] : $this->contact['phone']; }
  public function getPings() { return $this->ping; }
  public function getMayorships() { return $this->mayorships; }
  public function getTips() { return $this->tips; }
  public function getTodos() { return $this->todos; }
  public function getPhotos() { return $this->photos; }
  public function getFriends() { return $this->friends; }
  public function getFollowers() { return $this->followers; }
  public function getRequests() { return $this->requests; }
  public function getPageInfo() { return $this->pageInfo; }
  //setters
  
  public function setFirstname($n) {  
    $this->fname = $n;  
    return $this; 
  }
  public function setLastname($n) {
    $this->lname = $n;
    return $this;
  }
  public function setHomeCity($c) {
    $this->homeCity = $c;
    return $this;
  }
  public function setPhoto(FoursquarePhoto $p) {
    $this->photo = $p;
    return $this;
  }
  public function setGender($g) {
    switch($g) {
      case 'm': case 'male':
        $this->gender = 'm';
        break;
      case 'f': case 'female':
        $this->gender = 'f';
        break;
      default:
        $this->gender = null;
        break;      
    }
    return $this;
  }
  public function setRelationship($r) {
    $this->relationship = $r;
    return $this;
  }
  public function setType($t) {
    $this->type = $t;
    return $this;
  }
  public function setTwitter($t) {
    $this->contact['twitter'] = $t;
    return $this;
  }
  public function setPhone($p) {
    $this->contact['phone'] = $p;
    return $this;
  }
  public function setPhotos($p) {
    $this->photos = array_merge($this->photos,$p);
  }
  public function setTips($t = array()) {
    $this->tips = array_merge($this->tips,$t);
    return $this;
  }
  //public function 
}

?>
