<?php

namespace Ddnet\FoursquareBundle\Entity;

use Ddnet\FoursquareBundle\Entity\Location,
    Ddnet\FoursquareBundle\Entity\Category,
    Ddnet\FoursquareBundle\Entity\Tip,
    Ddnet\FoursquareBundle\Entity\User;

class Venue 
{
    protected 
        $id,
        $name,
        $contact = array (  
            'phone'             =>  '',
            'formattedPhone'    =>  ''
         ),
        $location,

        $categories = array(),
        $primaryCategory,

        $verified = false,

        $stats = array(
            'checkinsCount'     =>  0,
            'usersCount'        =>  0,
            'tipCount'          =>  0
        ),

        $url,
        $createdAt,

        $likes = array(
            'count'             =>  0,
            'groups'            =>  ''
        ),

        $specials = array(
            'count'             =>  0
        ),
            
        $mayor  = array( 
            'count'             =>  0,
            'user'              =>  ''
        ),
            
        $tips = array();
  
    /**
     * Get Id
     * 
     * @return integer
     */
    public function getId() 
    { 
        return $this->id; 
    }
  
    /**
     * Set Id
     * 
     * @param integer $id
     * 
     * @return \Ddnet\FoursquareBundle\Entity\Venue
     */
    public function setId(  $id   )
    {
        $this->id = $id;
    
        return $this;
    }

    /**
     * Get Name
     * 
     * @return string $name
     */
    public function getName() 
    {
        return $this->name; 
    }
    
    /**
     * Set The Name
     * 
     * @param string $name
     * 
     * @return \Ddnet\FoursquareBundle\Entity\Venue
     */
    public function setName(  $name   ) 
    {
        $this->name = $name;
      
        return $this;
    }

    /**
     * Get Contact Info
     * 
     * @param boolean $formatted
     * 
     * @return string
     */
    public function getContact(  $formatted = true   )
    {
        return (  $formatted && isset(  $this->contact[  'formattedPhone'  ]  )  ) ? $this->contact[  'formattedPhone'  ] : $this->contact[  'phone'  ];    
    }
    
    /**
     * Set Contact Info
     * 
     * @param array $contact
     */
    public function setContact(  array $contact = array()  ) 
    {
        $this->contact = $contact;
    }
  
    /**
     * Get Location Info
     * @return type
     */
    public function getLocation() 
    { 
        return $this->location; 
    }
    
    /**
     * Set Location Info
     * 
     * @param array|Ddnet\FoursquareBundle\Entity\Location $location
     */
    public function setLocation(  $location   ) 
    {
        if(  $location instanceof Location   )
        {
            $this->location = array(  $location   );
        }
        elseif(  is_array(  $location   )  ) 
        {
            $this->location = new Location();
            $this->location->fromArray(  $location   );
        }
        else
        {
            throw new FoursquareException(  'Location should be of type Ddnet\FoursquareBundle\Entity\Location or an array collection of the same type.'  );
        }
        
        return $this;
    }    
  
    /**
     * Get Arrays
     * @return array
     */
    public function getCategories() 
    { 
        return $this->categories; 
    }
    
    /**
     * Set Categories
     * 
     * @param array $categories
     * @return \Ddnet\FoursquareBundle\Entity\Venue
     * @throws FoursquareException
     */
    public function setCategories(  array $categories = array()  ) 
    {
        $this->categories = $categories;
        
        return $this;
    }
  
    /**
     * 
     * @return type
     */
    public function getPrimaryCategory() 
    {
        if( is_null( $this->primaryCategory )  ) 
        {
            foreach( $this->categories as $cat ) 
            {
                if( $cat->isPrimary()  ) 
                {
                    $this->setPrimaryCategory( $cat );
          
                    return $cat;
                }
            }      
            
            $this->setPrimaryCategory( $this->$categories[ 0 ]  );
      
            return $this->categories[ 0 ];
        }
        
        return $this->primaryCategory;
    }
  
    /**
     * Add A Primary Category (will overwrite existing value)
     * 
     * @param \Ddnet\FoursquareBundle\Entity\Category $category
     * @param boolean $addIfNone
     * 
     * @return \Ddnet\FoursquareBundle\Entity\Venue
     */
    public function addPrimaryCategory( Category $category, $addIfNone = true ) 
    {
        foreach( $this->categories as $cat ) 
        {
            if( $cat == $category ) 
            {
                $cat->setPrimary( true );
                $this->primaryCategory = $cat;
            }
        }    
    
        if( $addIfNone ) 
        {
            $category->setPrimary( true );
            $this->addCategory( $category );
            $this->primaryCategory = $category;
        }
    
        return $this;
    }
  
    /**
     * Add A Category
     * 
     * @param \Ddnet\FoursquareBundle\Entity\Category $category
     * @return \Ddnet\FoursquareBundle\Entity\Venue
     * @throws FoursquareException
     */
    public function addCategory( Category $category ) 
    {   
        $this->categories[] = $category;
      
        return $this;  
    }    
  
    /**
     * Is The Venue Verified?
     * 
     * @return boolean
     */
    public function isVerified() 
    { 
        return $this->verified; 
    }
  
    /**
     * Set The Venue Verification
     * 
     * @param boolean $verified
     * 
     * @return \Ddnet\FoursquareBundle\Entity\Venue
     */
    public function setVerified( $verified ) 
    {
        $this->verified = $verified;
    
        return $this;
    }
  
    /**
     * Get The Venue Stats
     * 
     * @return array
     */
    public function getStats() 
    { 
        return $this->stats; 
    }
  
    /**
     * Set The Stats
     * 
     * @param array $stats
     * 
     * @return \Ddnet\FoursquareBundle\Entity\Venue
     */
    public function setStats( array $stats = array() ) 
    {
        $this->stats = array_merge( $this->stats, $stats );
    
        return $this;
    }
  
    /**
     * Get The URL To The Venue
     * 
     * @return string
     */
    public function getUrl() 
    { 
        return $this->url; 
    }
  
    /**
     * Set The URL To The Venue
     * 
     * @param string $url
     * 
     * @return \Ddnet\FoursquareBundle\Entity\Venue
     */
    public function setUrl( $url ) 
    {
        $this->url = $url;
        
        return $this;
    }
  
    /**
     * Get Venue Likes or a count
     * 
     * @param boolean $count
     * 
     * @return integer|array
     */  
    public function getLikes( $count = true ) 
    { 
        switch( $count ) 
        {
            case false:
                return $this->likes;
                break;
            default:
                return $this->likes[ 'count' ];
                break;
        }
    }
    
    /**
     * Set Venue Likes
     * 
     * @param array $likes
     * 
     * @return \Ddnet\FoursquareBundle\Entity\Venue
     */
    public function setLikes( $likes ) 
    {
        $this->likes = $likes;
    
        return $this;
    }
  
    /**
     * Get Specials Or A Count
     * 
     * @param boolean $count
     * 
     * @return integer|array
     */
    public function getSpecials( $count = true ) 
    { 
        switch( $count ) 
        {
            case false:
                return $this->specials;
                break;
            default:
                return $this->specials[ 'count' ];
                break;
        }
    }
  
    /**
     * Set Specials
     * 
     * @param array $specials
     * 
     * @return \Ddnet\FoursquareBundle\Entity\Venue
     */
    public function setSpecials( $specials ) 
    {
        $this->specials = $specials;
        
        return $this;
    }  
  
    /**
     * Get When The Venue Was Created
     * 
     * @return datetime
     */
    public function getCreatedAt() 
    { 
        return $this->createdAt; 
    }
    
    /**
     * Set The Venue Creation Date
     * 
     * @param datetime $createdAt
     * 
     * @return \Ddnet\FoursquareBundle\Entity\Venue
     */
    public function setCreatedAt( $createdAt ) 
    {
        $this->createdAt = $createdAt;
      
        return $this;
    }
  
    /**
     * Get The Venue's Mayor Or A Count Of Mayors
     * 
     * @param boolean $count
     * 
     * @return integer|Ddnet\FoursquareBundle\Entity\User
     */
    public function getMayor( $count = false ) 
    {
        if( $count )
        {
            return $this->mayor[ 'count' ];
        }
        
        return $this->mayor[ 'user' ];
    }
    
    /**
     * Set The Mayor
     * 
     * @param \Ddnet\FoursquareBundle\Entity\User $user
     * @param boolean $count
     * 
     * @return \Ddnet\FoursquareBundle\Entity\Venue
     */
    public function setMayor( $user = null,$count = 0 ) 
    {
        if( !is_null( $user ) && (  $user instanceof User )  ) 
        {
            $this->mayor[ 'user' ] = $user;
        }
        elseif( !is_null( $user ) && is_array( $user )  ) 
        {
            $u = new User();
            $u->fromArray( $user );
        }
      
        $this->mayor[ 'count' ] = $count;
      
        return $this;
    }
  
    /**
     * Get Venue Tips
     * 
     * @return array
     */
    public function getTips() 
    { 
        return $this->tips; 
    }
  
    /**
     * Set Tips
     * 
     * @param array $tips
     * 
     * @return \Ddnet\FoursquareBundle\Entity\Venue
     */
    public function setTips( array $tips = array() ) 
    {
        $this->tips = $tips;
        
        return $this;
    }
    
    /**
     * Get A Venue Tip
     * 
     * @return \Ddnet\FoursquareBundle\Entity\Tip
     */
    public function getTip( Tip $tip ) 
    {
        return ( in_array( $tip, $this->tips ) ? $this->tips[ $tip ] : null );
    }
  public function addTip( $tip ) {   
    if( $tip instanceof fsTip ) {
      $this->tips[] = $tip;
      return $this;
    }
    elseif( is_array( $tip )  ) {
      $t = new fsTip();
      $t->fromArray( $tip );
      $this->tips[] = $tip;
      return $this;
    }
    else  throw new FoursquareException( 'Tip should be an array or a single entity of type Ddnet\FoursquareBundle\Entity\Tip'  );
  } 
  
  protected $tags = array();
  public function getTags() { return $this->tags; }
  public function setTags( $tags ) {
    $this->tags = array_merge( $this->tags,$tags );
  }
  
  protected $shortUrl;
  public function getShortUrl() { return $this->shortUrl; }
  public function setShortUrl( $sUrl ) {
    $this->shortUrl = $sUrl;
    return $this;
  }
  
  protected $timeZone = "America/New_York";
  public function getTimeZone() { return $this->timeZone; }
  public function setTimeZone( $tz ) {
    $this->timeZone = $tz;
    return $this;
  }
  
  protected $listed = array();
  public function getListed() { return $this->listed; }
  public function setListed( $listed ) {
    $this->listed = array_merge( $this->listed, $listed );
    return $this;
  }
  
  protected $phrases = array();
  public function getPhrases() { return $this->getPhrases; }
  public function setPhrases( $phrases ) {
    $this->phrases = array_merge( $this->phrases, $phrases );
    return $this;
  }
  
  public function fromArray( $arr ) {
    if( isset( $arr[ 'categories' ]  )  ) $this->SetCategories( $arr[ 'categories' ]  );
    if( isset( $arr[ 'url' ]  )  ) $this->SetUrl( $arr[ 'url' ]  );
    if( isset( $arr[ 'contact' ]  )  ) $this->SetContact( $arr[ 'contact' ]  );
    if( isset( $arr[ 'createdAt' ]  )  ) $this->SetCreatedAt( $arr[ 'createdAt' ]  );
    if( isset( $arr[ 'id' ]  )  ) $this->SetId( $arr[ 'id' ]  );
    if( isset( $arr[ 'likes' ]  )  ) $this->SetLikes( $arr[ 'likes' ]  );
    if( isset( $arr[ 'listed' ]  )  ) $this->SetListed( $arr[ 'listed' ]  );
    if( isset( $arr[ 'location' ]  )  ) $this->SetLocation( $arr[ 'location' ]  );
    if( isset( $arr[ 'mayor' ]  )  ) $this->SetMayor( $arr[ 'mayor' ]  );
    if( isset( $arr[ 'name' ]  )  ) $this->SetName( $arr[ 'name' ]  );
    if( isset( $arr[ 'phrases' ]  )  ) $this->SetPhrases( $arr[ 'phrases' ]  );
    if( isset( $arr[ 'shortUrl' ]  )  ) $this->SetShortUrl( $arr[ 'shortUrl' ]  );
    if( isset( $arr[ 'specials' ]  )  ) $this->SetSpecials( $arr[ 'specials' ]  );
    if( isset( $arr[ 'stats' ]  )  ) $this->SetStats( $arr[ 'stats' ]  );
    if( isset( $arr[ 'tags' ]  )  ) $this->SetTags( $arr[ 'tags' ]  );
    if( isset( $arr[ 'timeZone' ]  )  ) $this->SetTimeZone( $arr[ 'timeZone' ]  );
    if( isset( $arr[ 'tips' ]  )  )     $this->SetTips( $arr[ 'tips' ]  );
    if( isset( $arr[ 'verified' ]  )  ) $this->SetVerified( $arr[ 'verified' ]  );
    return $this;
  }
}

?>