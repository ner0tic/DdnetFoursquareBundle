## 2. Usage
Include needed library.
```php
  use Ddnet\FoursquareBundle\Foursquare as Foursquare;
```
Generate an instance.
```php
  $fs = new Foursquare();
```
Get an instance of yourself (if logged into foursquare.)
```php
  use Ddnet\FoursquareBundle\Entity\User as FsqUser; 
  $user = new FsqUser();
  // cleaning this up in next release...
  $user->fromArray(json_decode($fs->get('users/self')));
```      
Loop through your checkins.
```php
  foreach($user->getCheckins() as $checkin)
    echo $user->getFirstName()." checked into ".$checkin->getVenue()->getName()." at ".$checkin->getCreatedAt()."\n";
```