<?php

namespace Ddnet\FoursquareBundle\Entity;

class Event {

  protected $id;

  protected $name;
  
  protected $foreignIds = array(
      'count'   =>  0,
      'items'   => array()
      );
  
  protected $categories = array();
  
  protected $allDay = false;
  
  protected $date;
  
  protected $text;
  
  protected $url;
  
  protected $images = array();
  
  protected $provider;
  
  protected $stats = array(
      'checkinsCount'   =>  0,
      'usersCount'      =>  0
      );
}

?>