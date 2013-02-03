## 2. Usage
Include needed library.
```php
  use Ddnet\FoursquareBundle\Foursquare;
```
Generate an instance.
```php
  $foursquare = new Foursquare();
```
Get an instance of yourself (if logged into foursquare.)
```php
  use Ddnet\FoursquareBundle\Entity\User; 

  $user = new User();
  
  $user->fromArray(
    json_decode( $fs->get('users/self') ) 
  );
```      
Loop through your checkins.
```php
  foreach($user->getCheckins() as $checkin)
    echo $user->getFirstName()." checked into ".$checkin->getVenue()->getName()." at ".$checkin->getCreatedAt()."\n";
```