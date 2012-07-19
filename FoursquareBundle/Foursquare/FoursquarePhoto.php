<?php
/**
 * Description of FoursquarePhoto
 *
 * @author ner0tic
 */
namespace Ddnet\FoursquareBundle\Foursquare;
class FoursquarePhoto {
  protected
          $id         = null,
          $createdAt  = null,
          $url        = null,
          $sizes      = array(),
          $source     = array(),
          $user       = null,
          $venue      = null,
          $tip        = null,
          $checkin    = null;
  public static function createFromArray($a = array()) {
      if(sizeof($a)===0)   throw new FoursquareException('not an array');
      return new FoursquarePhoto($a);
  }  
  public function __construct() {
    $args = func_get_args();
  }
          
  public function getId() { return $this->id; }
  public function created($d=null) {
    if(!is_null($d)) $this->createAt = $d;
    return $this->createdAt;
  }
  public function getUrl() { return $this->url; }
  public function getSizes($count = true) {
    if(isset($this->sizes)) {
      if($count)  return $this->size['count'];
      else return $this->sizes['items'];
    }
    return $this->sizes;
  }
  public function getSource() { return $this->source; }
  public function getUser() { return $this->user; }
  public function getTip() { return $this->tip; }
  public function getCheckin() { return $this->checkin; }
}

?>
