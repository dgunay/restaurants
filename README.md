# Restaurants Picker

Helps you decide on a restaurant by maintaining a list of restaurants you like
and how often you've visited them. It chooses your least-visited restaurant
or selects one either totally randomly or semi randomly.

## Testing

Tests currently run on SQLite3 in-memory. The hope is with PDO you can use any 
DB you want, but I am not a SQL master so no guarantees the queries will work 
across every SQL implementation.

## Challenges

This idea was born of a practical need with a barebones, simplistic 
implementation. I simply thought that sites like <https://wtfsigte.com/>, 
while okay in a pinch, lacked the personal touch of knowing your usual eating 
spots; after all, most of the time my frustrations with the process were:

 - Paralysis from too much choice
 - Weird, biased justifications for not going somewhere
 - Inability to come up with a comprehensive list on-demand by heart
 
This project doesn't currently solve all of those, but in the future for 2 and 3
I'd like to include more data about each restaurant, and minimally also include
location data for each restaurant. There's a lot of potential here for the
use of some API like maybe Yelp's, but for now...

The principal thing I wanted to learn while building this was how to use
a proper unit testing framework (PHPUnit), and how to build a testable 
data-driven program. The last data-driven application I shipped professionally
had lackluster test coverage due to its reliance on data, both from an API
and from a SQL database constructed from that API data. 

I wanted to feel more prepared for the next time I had an opportunity to 
build a testable program. The simplicity of this idea made it a great place
to try and solidify bread and butter testing concepts.

I also wanted to try using PDO after reading so much about how `mysqli_*()`
and the like was terrible, so here I took a shot at that. I really like it.
I don't think I'm ever going back to be honest.

## For Later

If I end up caring more about the project long-term, Yelp API integration is
probably the next step.
