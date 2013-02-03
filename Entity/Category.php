<?php
namespace Ddnet\FoursquareBundle\Entity;

use Ddnet\FoursquareBundle\Exception\FoursquareException;

class Category 
{
    protected 
        $id,
            
        $name,
        $pluralName,
        $shortName,
            
        $icon = array( 
            'prefix'    =>  '',
            'suffix'    =>  ''
         ),
        
        $categories = array();       
        
    /**
     * Get Id
     * 
     * @return string
     */
    public function getId() 
    { 
        return $this->id; 
    }
    
    /**
     * Set Id
     * 
     * @param string $id
     * 
     * @return \Ddnet\FoursquareBundle\Entity\Category
     */
    public function setId( $id ) 
    {
        $this->id = $id;
      
        return $this;
    }

    /**
     * Get Name
     * 
     * @return string
     */
    public function getName() 
    { 
        return $this->name; 
    }
    
    /**
     * Set Name
     * 
     * @param string $name
     * 
     * @return \Ddnet\FoursquareBundle\Entity\Category
     */
    public function setName( $name ) 
    {
        $this->name = $name;
      
        return $this;
    }
  
    /**
     * Get Pluralized Version Of Name
     * 
     * @return string
     */
    public function getPluralName() 
    { 
        return $this->pluralName; 
    }
    
    /**
     * Set Pluralized Version Of Name
     * 
     * @param string $pluralName
     * 
     * @return \Ddnet\FoursquareBundle\Entity\Category
     */
    public function setPluralName( $pluralName ) 
    {
        $this->pluralName = $pluralName;
      
        return $this;
    }  

    /**
     * Get A Short Version Of Name
     * 
     * @return string
     */
    public function getShortName() 
    { 
        return $this->shortName; 
    }
    
    /**
     * Set A Short Version Of Name
     * 
     * @param string $shortName
     * 
     * @return \Ddnet\FoursquareBundle\Entity\Category
     */
    public function setShortName( $shortName ) 
    {
        $this->name = $shortName;
      
        return $this;
    }  

    /**
     * Get Icon
     * @param type $part
     * @return type
     */
    public function getIcon( $part = array() ) 
    { 
        switch( $part ) 
        {
            case 'pre':
            case 'prefix':
            case 'p':
                return $this->icon[ 'prefix' ];
                break;
            case 'suf':
            case 'suffix':
            case 's':
                return $this->icon[ 'suffix' ];
                break;
            default:
                return $this->icon;
                break;
        }
    }
    
    /**
     * Set An Icon
     * 
     * @param array $icon
     * 
     * @return \Ddnet\FoursquareBundle\Entity\Category
     */
    public function setIcon( array $icon = array() ) 
    {
        $this->icon = $icon;
      
        return $this;
    }

    /**
     * Get Children
     * 
     * @return array
     */
    public function getChildren() 
    { 
        return $this->children; 
    }
    
    /**
     * Set Children
     * 
     * @param array $children
     * @param boolean $merge
     * 
     * @return \Ddnet\FoursquareBundle\Entity\Category
     */
    public function setChildren( array $children = array(), $merge = false ) 
    {
        if( $merge )
        {
            $this->children = array_merge( $this->children, $children );
        }
        else
        {
            $this->categories = $categories;
        }
      
        return $this;
    }
    
    public function getCategory( $child ) 
    {
        return isset( $this->children[ $child ]) ? $this->children[ $child] : null;
    }
    
    public function addChild( Category $child ) 
    {   
        if( !$this->children[ $child->getName() ] )
        {
            $this->children[] = $child;
        }
        else
        {
            throw new FoursquareException( 'Child already exists.' );
        }
        
        return $this;      
    }  
}
