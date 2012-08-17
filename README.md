##Documention
---
1. Installation
2. Usage
  - Checkin
  - Venue
  - User
  - Event
  - Photo
3. Test

## TODO
---
- OAuth connect (FOSUserBundle?)
- Entities
  + list
  + tip
  + special
- Fork for "Venues Platform" version and "Merchant Platform" version?


## 1. Installation

## 2. Usage
Include needed library
> use Ddnet\FoursquareBundle\Foursquare as Foursquare;

Generate an instance
> $fs = new Foursquare();

Get an instance of yourself (if logged into foursquare)
> use Ddnet\FoursquareBundle\Entity\User as FsqUSer;
> $user = new FsqUser();
> $user->fromArray(json_decode($fs->get('users/self')));

loop through your checkins
> foreach($user->getCheckins() as $checkin)
>   echo $user->getFirstName().' checked into '.$checkin->getVenue()->getName().' at '.$checkin->getCreatedAt().'<br />';
