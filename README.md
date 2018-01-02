# neamar.fr
This is a port from a 2005 website. I've tried to adapt it to work with Dokku to make sure I don't have to pay for it.


* Add `DATABASE_URL` as an environment variable
* Link to a SQL database with all the tables
* `dokku storage:mount neamar /var/lib/dokku/data/storage/neamar:/app/mount`
