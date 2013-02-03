## 3. Enpoints

### 3b. Venue
This maps the User endpoint to a usable entity.

#### Parameters
- id: contains the venueId from the venue endpoint
- name: the venue's name
- contact: an array of contact information (phone number, formatted phone number)
- location: the venue's location information (address, geocode, etc)
- categories: an array of categoryIds linked to the given endpoint
- primaryCategory: the default category for the given endpoint
- isVerified: boolean whether or not the given endpoint has been verified as a real location
- stats: an array of stats for the given endpoint (checkinsCount, usersCount, tipCount)
- likes: an array containing a like information for the given endpoint
- specials: an array of specials offered by the given endpoint
- createdAt: timestamp of when the endpoint was created
- mayor: an array containing a mayor count and the current mayor user endpoint
- tips: an array of tips linked to the given endpoint
- tags: an array of tags for the given endpoint
- shortUrl: a string for a shorter url to the foursquare page
- timeZone: a timezone listing for the given endpoint (default: America/New_York)
- listed: an array of listed items
- phrases: an array of phrases
- photos: an array of photos associated with the given endpoint

#### Methods
Each parameter has a getter and setter (getFirstName, setLastName)
fromArray(Array $array): takes in an array and generates a Symfony2 entity from the given array