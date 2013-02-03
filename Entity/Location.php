<?php
namespace Ddnet\FoursquareBundle\Entity;

use Ddnet\FoursquareBundle\Entity\Venue;

class Location 
{
    protected 
        $venue = null,
        $address = null,
        $crossStreet,
            
        $latitude = 0.0,
        $longitude = 0.0,
            
        $city = '',
        $zone = '',
        $country = '',
        $cc = '',
        $postalCode = '';
    
    /**
     * Get Venue
     * 
     * @return \Ddnet\FoursquareBundle\Entity\Venue
     */
    public function getVenue() 
    { 
        return $this->venue; 
    }
    
    /**
     * Set Venue
     * 
     * @param \Ddnet\FoursquareBundle\Entity\Venue $venue
     * 
     * @return \Ddnet\FoursquareBundle\Entity\Location
     */
    public function setVenue( Venue $venue )
    {
        $this->venue = $venue;
    
        return $this;
    }

    /**
     * Get Address
     * 
     * @return string
     */
    public function getAddress() 
    { 
        return $this->address; 
    }
    
    /**
     * Set Address
     * 
     * @param string $address
     * 
     * @return \Ddnet\FoursquareBundle\Entity\Location
     */
    public function setAddress( $address ) 
    {
        $this->address = $address;
      
        return $this;
    }

    /**
     * Get Cross Street
     * 
     * @return string
     */
    public function getCrossStreet() 
    { 
        return $this->crossStreet; 
    }
    
    /**
     * Set Cross Street
     * 
     * @param string $cross_street
     * @return \Ddnet\FoursquareBundle\Entity\Location
     */
    public function setCrossStreet( $cross_street ) 
    {
        $this->crossStreet = $cross_street;
      
        return $this;
    }

    /**
     * Get Latitude (short)
     * 
     * @return float
     */
    public function getLat() 
    { 
        return $this->latitude; 
    }
    
    /**
     * Get Latitude
     * 
     * @return float
     */
    public function getLatitude() 
    { 
        return $this->latitude(); 
    }
    
    /**
     * Set Latitude (short)
     * 
     * @param float $latitude
     * 
     * @return \Ddnet\FoursquareBundle\Entity\Location
     */
    public function setLat( $latitude ) 
    {
        $this->latitude = $latitude;
      
        return $this;
    }
    
    /**
     * Set Latitude
     * 
     * @param float $latitude
     * 
     * @return type
     */
    public function setLatitude( $latitude ) 
    { 
        return $this->setLat( $latitude ); 
    }

    /**
     * Get Longitude (Short)
     * 
     * @return float
     */
    public function getLng() 
    { 
        return $this->longitude; 
    }
    
    /**
     * Get Longitude
     * 
     * @return float
     */
    public function getLongitude() 
    { 
        return $this->getLongitude(); 
    }
    
    /**
     * Set Longitude (Short)
     * 
     * @param float $longitude
     * 
     * @return \Ddnet\FoursquareBundle\Entity\Location
     */
    public function setLng( $longitude ) 
    {
        $this->lng = $longitude;
      
        return $this;
    }
    
    public function setLongitude( $longitude ) 
    { 
        return $this->longitude  = $longitude; 
    }

    /**
     * Get Postal Code
     * 
     * @return string
     */
    public function getPostalCode() 
    { 
        return $this->postalCode; 
    }
    
    /**
     * Set Postal Code
     * 
     * @param string $postal_code
     * 
     * @return \Ddnet\FoursquareBundle\Entity\Location
     */
    public function setPostalCode( $postal_code ) 
    {
        $this->postalCode = $postal_code;
      
        return $this;
    }

    /**
     * Get City
     * 
     * @return string
     */
    public function getCity() 
    { 
        return $this->city; 
    }
    
    public function setCity( $city ) 
    {
        $this->city = $city;
      
        return $this;
    }

    /**
     * Get Zone
     * 
     * @return string
     */
    public function getZone() 
    { 
        return $this->zone; 
    }
    
    /**
     * Get State
     * 
     * @return string
     */
    public function getState() 
    { 
        return $this->zone; 
    }
    
    /**
     * Set Zone
     * @param string $zone
     * 
     * @return \Ddnet\FoursquareBundle\Entity\Location
     */
    public function setZone( $zone ) 
    {
        $this->zone = $zone;
      
        return $this;      
    }
    
    /**
     * Set State
     * 
     * @param string $state
     * 
     * @return \Ddnet\FoursquareBundle\Entity\Location
     */
    public function setState( $state ) 
    { 
        $this->zone = $state; 
        
        return $this;
    }

    /**
     * Get Country
     * 
     * @return string
     */
    public function getCountry() 
    { 
        return $this->country; 
    }
    
    public function setCountry( $country ) 
    {
        $this->country = $country;
      
        return $this;
    }

    /**
     * Get Country Code (Micro)
     * 
     * @return string
     */
    public function getCC() 
    { 
        return $this->cc; 
    }
    
    /**
     * Get Country Code
     * 
     * @return string
     */
    public function getCountryCode() 
    { 
        return $this->cc; 
    }
    
    /**
     * Get Country Code (Short)
     * 
     * @return string
     */
    public function getCode() 
    { 
        return $this->cc; 
    }
    
    /**
     * Set Country Code (Micro)
     * 
     * @param string $cc
     * 
     * @return \Ddnet\FoursquareBundle\Entity\Location
     */
    public function setCC( $cc )
    {
        $this->cc = $cc;
      
        return $this;
    }
    
    /**
     * Set Country Code
     * 
     * @param string $code
     * @return \Ddnet\FoursquareBundle\Entity\Location
     */
    public function setCountryCode( $code ) 
    { 
        return $this->cc = $code; 
    }
    
    /**
     * Set Country Code (Small)
     * 
     * @param string $code
     * @return \Ddnet\FoursquareBundle\Entity\Location
     */
    public function setCode( $code ) 
    { 
        return $this->cc = $code; 
    }

    public function fromArray( $array ) {
      if( isset( $array['address'] ) ) $this->setAddress( $array['address'] );
      if( isset( $array['cc'] ) ) $this->setCC( $array['cc'] );
      if( isset( $array['city'] ) ) $this->setCity( $array['city'] );
      if( isset( $array['country'] ) ) $this->setCountry( $array['country'] );
      if( isset( $array['crossStreet'] ) ) $this->setCrossStreet( $array['crossStreet'] );
      if( isset( $array['lat'] ) ) $this->setLat( $array['lat'] );
      if( isset( $array['lng'] ) ) $this->setLng( $array['lng'] );
      if( isset( $array['postalCode'] ) ) $this->setPostalCode( $array['postalCode'] );
      if( isset( $array['state'] ) ) $this->setState( $array['state'] );
      if( isset( $array['venue'] ) ) $this->setVenue( $array['venue'] );
      return $this;
    }
}
