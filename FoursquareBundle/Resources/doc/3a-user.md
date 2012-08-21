### Enpoints

#### User
This maps the User endpoint to a usable entity.

##### Parameters
- id: contains the userId from the user endpoint
- firstName: the user's first name
- lastName: the user's last name
- relationship: the relationship between the authenticated user and the given endpoint
- friends: an array of userIds linked to the given endpoint
- type: the user type of the given endpoint
- lists: an array of list items associated to the given endpoint
- tips: an array of tips linked to the given endpoint
- gender: the user's gender
- homeCity: the associated home town of the given endpoint
- bio: the biography of the given endpoint
- contact: an array of contact information (phone number, email address, [twitter username], [facebook user id])
- pings: boolean toggling notification pushes to mobile users
- badges: an array of earned badges by the given endpoint
- mayorships: an array of venue mayorships of the given endpoint
- checkins: an array of checkins from the given endpoint (defaults to returning 100, max: 250)
- following: an array of items (users, pages, tips, lists, etc) the given endpoint is following
- requests: a count of requests pending for the given endpoint
- photos: an array of photos associated with the given endpoint
- scores: an array of checkin scoring (recent, max, checkinsCount)
- referralId: the userId of referred given endpoint

##### Methods
Each parameter has a getter and setter (getFirstName, setLastName)
