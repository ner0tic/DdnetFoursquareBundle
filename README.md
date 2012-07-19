Current usage:

$fs = new Ddnet\FoursquareBundle\Foursquare();

$user = new Ddnet\FoursquareBundle\Entity\User();
$user->fromArray(json_decode($fs->get('users/self')));

foreach($user->getCheckins() as $checkin)
  echo $user->getFirstName().' checked into '.$checkin->getVenue()->getName().' at '.$checkin->getCreatedAt().'<br />';

Entities:
User
Venue
Checkin
Tip
Event
Category
Location
Photo