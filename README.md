DEPRECATED
==========
This site is being completely re-written and due for re-leaunch late February 2012.

If you would like to take a sneak preview of the new site, please visit:

<http://earth-explorer.appspot.com>

Thanks! Feedback is much appreciated!


Introduction
============
[EarthExplorer.info] was first concieved one weekend while talking with my 
10yo son about geography. We were talking about how different 
geographical descriptions are like containers and can be neighboured or 
even overlap.

I figured the best way for him to get his head around it was to explore the 
world for himself. At the time I had a bit of interest in the [Yahoo! GeoPlanet].
data so I set to creating [EarthExplorer.info].

The total code base took about a day all up including looking around for a 
decent template. It's a bit rough, but I wanted to get it out there.

I'm certainly interested in hearing any suggestions or receiving patches/updates.

How It Works
============
The [Yahoo! GeoPlanet] data is selected using the [Yahoo! Query Language]. 
Since this kind of data doesn't change too often (except in the more 
politically volatile areas of the world), we kind of cheat and cache the geo 
data. We also query Wikipedia for any interesting information about 
the area being viewed. I was thinking of using [Freebase] as it looks like
a *very* interesting database, but the learning curve was too high at the time
so it simply has a [Freebase] information popup in the search field.

Application Configuration
=========================
You will need to configure the `earthexplorer.properties` file. This
file is used to populate the `app/config/settings.xml` file in both the
development and production environments. Once this has been completed, you
can setup the development environment by running `agavi configure`. When you
are ready for production use `agavi deploy`. The following settings
show what needs to be entered into the `earthexplorer.properties` file:

- `YAHOO.ymappid` - [Yahoo! Maps] application id
- `reCAPTCHA.publicKey` and `reCAPTCHA.privateKey` - 
  [reCAPTCHA] keys for the contacts page
- `Google.site.verification` - the site verification code provided by
  [Google Webmaster Tools]
- `Google.analytics` - [Google Analytics] tracking code
- `UserVoice.key`, `UserVoice.host`, `UserVoice.forum` - codes from your 
  [UserVoice] account
- `Contact.email` and `Contact.subjectPrefix` - are used by the contact form
  for sending information to the configured email address. You can confiure a
  subject prefix that will be prepended to the subject the user has entered
  
Google AdSense
--------------
I haven't worried about extracting the AdSense settings yet, so they are still hard
coded in the template. You can find the AdSense module in `app/modules/AdSense`.
You'll have to replace the `google_ad_client` and `google_ad_slot` with the 
values from your own AdSense account.

Alternatively, I have no problems at all with you leaving the ads in place with
my codes :)

Apache Configuration
====================
A sample apache configuration file can be found 
in `dev/apache/earthexplorer.info.conf`. Obviously you will need to configure
this to suit your particular host and paths.

Installation
============
This project is based on the [Agavi PHP application framework][agavi] so you 
need to be familiar with that. Be sure that the agavi shell script is in your
path. If you don't have Agavi installed you can use the supplied agavi script
`dev/bin/agavi.sh`. Just be sure to edit the script so that 
`AGAVI_SOURCE_DIRECTORY` points to the *absolute* agavi library path in 
`libs/agavi`

From the shell execute the agavi/phing "deploy" task with `agavi deploy`. 
The defaults are kept in the file `earthexplorer.properties`. 

Permissions
===========
Make sure the following directories are writable by the web server:

-	app/cache
-	app/GeoNamesCache
-	app/YQLCache

The agavi/phing "deploy" task will change the permissions to 777, but you may
want to change this to something a little more secure on your installation



[EarthExplorer.info]: http://www.earthexplorer.info/
[agavi]: http://www.agavi.org/
[Yahoo! GeoPlanet]: http://developer.yahoo.com/geo/geoplanet/
[Yahoo! Query Language]: http://developer.yahoo.com/yql/
[Yahoo! Maps]: http://developer.yahoo.com/maps/
[Google Webmaster Tools]: http://www.google.com/webmasters/
[Google Analytics]: http://www.google.com/analytics/
[reCAPTCHA]: http://www.google.com/recaptcha/
[UserVoice]: http://uservoice.com/
