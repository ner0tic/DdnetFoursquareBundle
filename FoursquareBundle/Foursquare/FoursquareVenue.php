<?php
/**
 * Description of FoursquareVenue
 *
 * @author ner0tic
 */
namespace Ddnet\FoursquareBundle\Foursquare;
class FoursquareVenue { //extends FoursquareBase {
  protected 
            $id             = null,
            $createdAt      = null,
            $name           = null,
            $contact        = array(
              'twitter'       => null,
              'phone'         => null,
              'formattedPhone'=> null,
            ),
            $location       = array(
              'street'        => null,
              'cross_street'  => null,
              'city'          => null,
              'zone'          => null,
              'country'       => null,
              'postalCode'    => null,
              'lat'           => null,
              'lng'           => null,
            ),
            $categories     = array(),
            $verified       = false,
            $stats          = null,
            $url            = null,
            $menu           = array(),
            $specials       = array(),
            $hereNow        = array();
  protected $description    = null,
            $mayor          = array(),
            $tips           = array(),
            $listed         = array(),
            $tags           = array(),
            $beenHere       = null,
            $shortUrl       = null,
            $canonicalUrl   = null,
            $specialsNearby = array(),
            $photos         = array(),
            $roles          = array(),
            $timezone       = null;
  
  public static function createFromArray($a = array()) {
      if(sizeof($a)===0)   throw new FoursquareException('not an array');
      return new FoursquareVenue($a);
  }
  
  public function __construct() { 
    $args = func_get_args();
//    parent::__construct($id);
//    $this->setId($id); 
//    $this->createdAt = time();
    switch(func_num_args()) {
      case 1:
        if(is_array($args)) {
            $this->fromArray($args[0]);
        }
        else {
          $json = json_decode(Foursquare::retrieve('venues/'.$args[0]),true);
          
          $this->fromArray($json['response']['venue']);
        }
        break;
      case 2:
        $json = json_decode(FoursquareVenue::search('venues/search',array(
            'll'    => is_object($args[1]) ? $args[1]->getCoords() : $args[1]
        )),true);
          $this->fromArray($json['response']['venue']);
        break;
      default:
        throw new FoursquareException('invalid parameters supplied');
        break;
    }
  }
   
  public function getId() { return $this->id; }
  public function getName() { return $this->name; }
  public function isVerified() { return $this->verified; }
  public function getCreated($fmt='m/d/Y') { return date($fmt,$this->created); }
  public function getPhone($formatted = true) { return $formatted ? $this->$this->contact['formattedPhone'] : $this->contact['phone']; }
  public function getUrl($which = 0) { return ($which == 2) ?$this->canonicalUrl : (($which == 2) ? $this->shortUrl : $this->url);  }
  public function getStats() { return $this->stats; }
  public function getTimezone() { return $this->timezone; }
  
  public function getCoords() { return $this->location['lat'].','.$this->location['lng']; }
  public function getLatitude() { return $this->location['lat']; }
  public function getLongitude() { return $this->location['lng']; }
  public function getStreet() { return $this->location['street']; }
  public function getCrossStreet() { return isset($this->location['cross_street']) ? $this->location['cross_street'] : ''; }
  public function getCity(){ return $this->location['city']; }
  public function getZone() { return $this->location['zone']; }
  public function getCountry() { return $this->location['country']; }
  public function getPostalCode() { return $this->location['postalCode']; }
  
  public function getCategory() {
    foreach($this->categories as $category) {
      if($category->isPrimary())  return $category;
    }
    return null;
  }
  public function getCategories() { return $this->categories; }
  public function getTips() { return $this->tips; }
  public function getTags() { return $this->tags; }
  public function getPhotos() { return $this->photos; }
  public function getSpecials() { return $this->specials; }
  
  public function getMayor() { return $this->mayor; }
  public function getMayorCount() { return isset($this->mayor['count']) ? $this->mayor['count'] : '0'; }
  public function getListed() { return $this->listed(); }
  public function getHereNow() { return $this->hereNow; }
  
  public function setName($n) { 
    $this->name = $n; 
    return $this; 
  }
  public function setVerification(bool $v) { 
    $this->verified = $v;
    return $this;
  }
  public function setPhone($p) {
    $this->phone = $p;
    return $this;
  }
  public function setUrl($u,$s=false) {
    if($s)  $this->s_url = $u;
    else $this->url = $u;
    return $this;
  }
  public function setTimeZone($t) {
    $this->timezone = $t;
    return $this;
  }
  public function setStats($s = array()) {
    //do something
    return $this;
  }
  
  public function setCoords($lat,$lng) {
    $this->setLatitude($lat)->setLongitude($lng);
    return $this;
  }
  public function setLatitude($l) {
    $this->lat = $l;
    return $this;
  }
  public function setLongitude($l) {
    $this->lng = $l;
    return $this;
  }
  public function setStreet($s) {
    $this->street = $s;
    return $this;
  }
  public function setCrossStreet($c) {
    $this->cross_street = $c;
    return $this;
  }
  public function setCity($c) {
    $this->city = $c;
    return $this;
  }
  public function setZone($z) { 
    $this->zone = $z;
    return $this;
  }
  public function setCountry($c) {
    $this->country = $c;
    return $this;
  }
  public function setPostalCode($p) {
    $this->postal_code = $p;
    return $this;
  }
  
  public function setCategories($c = array()) {
    $this->categories = array_merge($this->categories,$c);
    return $this;
  }
  public function setTips($t = array()) {
    $this->tips = array_merge($this->tips,$t);
    return $this;
  }
  public function setTags($t = array()) {
    $this->tags = array_merge($this->tags,$t);
    return $this;
  }
  public function setPhotos($p = array()) {
    $this->photos = array_merge($this->photos,$p);
    return $this;
  }
  public function setSpecials($s = array()) {
    $this->specials = array_merge($this->specials,$s);
    return $this;
  }

  public static function search($params = array()) {
    return Foursquare::retrieve('venues/search', $params);
  }
  
  public function hasCategory($n) { return isset($this->categories[$n]); } 
  
  public function fromArray($a = array()) {
    //foreach($a as $key => $value) {
//        sfContext::getInstance()->getLogger()->info("$key => $value");
//      if(is_array($value)) {
//        foreach($value as $k => $v) {
//          $this->$key[$k] = $v;
//        }
//      }
//      else
//        $this->$key = $value;
        if(isset($a['id']))                         $this->id                 = $a['id'];
        if(isset($a['createdAt']))                  $this->createdAt          = $a['createdAt'];
        if(isset($a['name']))                       $this->name               = $a['name'];
        
        if(isset($a['contact']['twitter']))         $this->contact['twitter'] = $a['contact']['twitter'];
        if(isset($a['contact']['phone']))           $this->contact['phone']   = $a['contact']['phone'];
        if(isset($a['contact']['formattedPhone']))  $this->contact['formattedPhone'] = $a['contact']['formattedPhone'];
        
        if(isset($a['location']['street']))         $this->location['street'] = $a['location']['street'];
        if(isset($a['location']['cross_street']))   $this->location['cross_street'] = $a['location']['cross_street'];
        if(isset($a['location']['city']))           $this->location['city']   = $a['location']['city'];
        if(isset($a['location']['zone']))           $this->location['zone']   = $a['location']['zone'];
        if(isset($a['location']['country']))        $this->location['country'] = $a['location']['country'];
        if(isset($a['location']['postalCode']))     $this->location['postalCode'] = $a['location']['postalCode'];
        if(isset($a['location']['lat']))            $this->location['lat'] = $a['location']['lat'];
        if(isset($a['location']['lng']))            $this->location['lng'] = $a['location']['lng'];
        
        if(isset($a['categories']) && (is_array($a['categories']))) {
          foreach($a['categories'] as $category)  $this->categories[] = new FoursquareCategory($category);
        }
        
        if(isset($a['verified']))                   $this->verified           = $a['verified'];
        if(isset($a['stats']))                      $this->stats              = $a['stats'];
        if(isset($a['url']))                        $this->url                = $a['url'];
        if(isset($a['menu']))                       $this->menu               = $a['menu'];
        
        if(isset($a['specials']) && (is_array($a['specials'] && sizeof($a['specials'] > 0)))) {
          foreach($a['specials'] as $special)  $this->specials[] = $special; //FoursquareSpecial::createFromArray($special);
        }
        
        if(isset($a['hereNow']) && (is_array($a['hereNow'] && sizeof($a['hereNow'] > 0)))) {
          foreach($a['hereNow'] as $now)  $this->hereNow[] = $now;
        }
        
        if(isset($a['description']))                $this->description        = $a['description'];
        if(isset($a['mayor']))                      $this->mayor              = $a['mayor'];

        if(isset($a['tips']) && (is_array($a['tips'] && sizeof($a['tips'] > 0)))) {
          foreach($a['tips'] as $tip)  $this->tips[] = $tip; // new FoursquareTip($tip);
        }        
        
        if(isset($a['listed']) && (is_array($a['listed'] && sizeof($a['listed'] > 0)))) {
          foreach($a['listed'] as $list)  $this->listed[] = $list;
        }      
        
        if(isset($a['tags']) && (is_array($a['tags'] && sizeof($a['tags'] > 0)))) {
          foreach($a['tags'] as $tag)  $this->tags[] = $tag;
        }        
        
        if(isset($a['beenHere']))                   $this->beenHere           = $a['beenHere'];
        if(isset($a['shortUrl']))                   $this->shortUrl           = $a['shortUrl'];
        if(isset($a['canonicalUrl']))               $this->canonicalUrl       = $a['canonicalUrl'];

        if(isset($a['specialsNearby']) && (is_array($a['specialsNearby'] && sizeof($a['specialsNearby'] > 0)))) {
          foreach($a['specialsNearby'] as $special)  $this->specialsNearby[] = $special; // new FoursquareSpecial($special);
        }              
        
        if(isset($a['photos']) && (is_array($a['photos'] && sizeof($a['photos'] > 0)))) {
          foreach($a['photos'] as $photo)  $this->photos[] = $photo; // new FoursquarePhoto($photo);
        }        
        
        if(isset($a['roles']) && (is_array($a['roles'] && sizeof($a['roles'] > 0)))) {
          foreach($a['roles'] as $role)  $this->roles[] = $role;
        }                
        
    }    
    
    /*

            $location       = array(
              'street'        => null,
              'cross_street'  => null,
              'city'          => null,
              'zone'          => null,
              'country'       => null,
              'postalCode'    => null,
              'lat'           => null,
              'lng'           => null,
            ),
            $listed     = array(),
            $stats       = false,
            $stats          = null,
            $description            = null,
            $description           = array(),
            $specials       = array(),
            $listed        = array();
  protected $description    = null,
            $mayor          = array(),
            $tips           = array(),
            $listed         = array(),
            $specialsNearby           = array(),
            $beenHere       = null,
            $shortdescription       = null,
            $canonicaldescription   = null,
            $specialsNearby = array(),
            $photos         = array(),
            $roles          = array(),
            $timezone       = null;
                   * */
                   
  //}
}

?>
