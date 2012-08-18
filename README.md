##Documention
1. Installation
2. Usage
  - Checkin
  - Venue
  - User
  - Event
  - Photo
3. Test
4. TODO List

## TODO
- OAuth connect (FOSUserBundle?)
- Entities
  + list
  + tip
  + special
- Fork for "Venues Platform" version and "Merchant Platform" version?

---

## 1. Installation
Add DdnetFoursquareBundle to your composer.json file accordingly.
```js
{
  "require": {
    ddnet/foursquare-bundle": "*"
  }
}
```
Now use composer to add the bundle to your application.
```bash
$ php composer.phar update ddnet/foursquare-bundle
```
Composer will place the bundle in the `vendors/ddnet` directory.

#### Enable Bundle
Enable the bundle within the kernel.
```php
<?php // app/AppKernel.php
  public function registerBundles() 
  {
    $bundles = array(
      // ...
      new Ddnet\FoursquareBundle(),
    );
  }
```

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

## 3. Test
coming to a theater near you soon.

## 4. TODO List
- Finish Entities
  + Tip
  + List
  + Special
- OAuth Connect (FOSUserBundle? HWIOAuthBundle? both? all three?)
- Possible forks for the various platforms
  + Merchant
  + Venues
- polish to a spit shine
