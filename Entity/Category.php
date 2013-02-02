<?php

namespace Ddnet\FoursquareBundle\Entity;

class Category {

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
  
  protected $pluralName;
  public function getPluralName() { return $this->pluralName; }
  public function setPluralName($pluralName) {
    $this->pluralName = $pluralName;
    return $this;
  }  
  
  protected $shortName;
  public function getShortName() { return $this->shortName; }
  public function setShortName($shortName) {
    $this->name = $shortName;
    return $this;
  }  
  
  protected $icon = array(
      'prefix'    =>  '',
      'suffix'    =>  ''
      );
  public function getIcon($part='array') { 
    switch($part) {
      case 'pre':
      case 'prefix':
      case 'p':
        return $this->icon['prefix'];
        break;
      case 'suf':
      case 'suffix':
      case 's':
        return $this->icon['suffix'];
        break;
      default:
        return $this->icon;
        break;
    }
  }
  public function setIcon($icon) {
    $this->icon = $icon;
    return $this;
  }
  
  protected $categories = array();
  public function getCategories() { return $this->categories; }
  public function setCategories($categories) {
    if($categories instanceof \Self) $this->categories = array($categories);
    elseif(is_array($categories)) {
      $this->categories = $categories;
    }
    else  throw new FoursquareException('Category should be an array of Category Entities or a single entity of type Ddnet\FoursquareBundle\Entity\Category');
    return $this;
  }
  public function getCategory() {
    foreach($category as $categories) {
      if($category->getPrimary()) return $category;
    }
    return $this->categories[0];
  }
  public function addCategory($category) {   
    if($category instanceof \Self) {
      $this->categories[] = $category;
      return $this;
    }
    elseif(is_array($category)) {
      $c = new \Self();
      $c->fromArray($category);
      return $this;
    }
    else  throw new FoursquareException('Category should be an array or a single entity of type Ddnet\FoursquareBundle\Entity\Category');
  }  
  
  protected $primary = false;
  public function isPrimary() { return $this->primary; }
  public function setPrimary($primary) {
    $this->primary = $primary;
    return $this;
  }
}

?>