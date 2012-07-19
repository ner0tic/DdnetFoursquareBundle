<?php
/**
 * Description of FoursquareCategory
 *
 * @author ner0tic
 */
namespace Ddnet\FoursquareBundle\Foursquare;
class FoursquareCategory {
  private $icon_sizes = array(32,44,64,88,256);
  protected
    $id         = null,
    $name       = null,
    $pluralName = null,
    $shortName  = null,
    $icon       = array(),
    $primary    = null;
  
  public static function createFromArray($a = array()) {
    if(sizeof($a)===0)   throw new FoursquareException('not an array');
    return new FoursquareCategory($a);
  }
  public function __construct() {
    if(func_num_args()===0) throw new FoursquareNotFoundException('Missing required parameters.');
    foreach(func_get_args() as $arg) {
      $this->id         = $arg['id'];
      $this->name       = $arg['name'];
      $this->pluralName = $arg['pluralName'];
      $this->shortName  = $arg['shortName'];
      $this->icon       = $arg['icon'];
      $this->primary    = $arg['primary'];
      
    }
  }
  public function isPrimary() { return (bool) $this->primary; }
  public function getName() { return $this->name; }
  public function getPluralName() { return $this->pluralName; }
  public function getShortName() { return $this->shortName; }
  public function getIcon($size=32) {
//    if(!is_integer($size) || !in_array($size, $this->icon_sizes))
//      $size = 32;
//    return sprintf('%s%d%s',$this->icon['prefix'],$size,$this->icon['name']);   
    return $this->icon;
  }
  public function toArray($json=false) {
    if($json) return null;
   return array(
        'id'          => $this->id,
        'name'        =>  $this->getName(),
        'pluralName'  =>  $this->getPluralName(),
        'shortName'   =>  $this->getShortName(),
        'icon'        =>  array(
            'prefix'  =>  $this->icon['prefix'],
            'sizes'    =>  $this->icon['sizes'],
            'name'    =>  $this->icon['name'],
            ),
        'primary'     =>  $this->primary,
        );
  }
}

?>
