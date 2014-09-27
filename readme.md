Chef webui in PHP (with Laravel framework)
==========================================

What is it ?
------------

This is a project created just to have fun with Laravel and at the same time do something useful for me. The bundled web UI with the open source chef server makes it really difficult to do quick changes.

Why ?
-----

The current open source webui is really slow, ugly, hard to use and not maintained. See https://coderanger.net/chef-webui/ for what could be it's future. Doing node attribute/runlist edition with Knife really isn't sysops friendly :/

Features
--------

* No JSON editing. Anywhere.
* Simple databag creation/edition. No JSON.
* Very fast because of aggressive caching of API calls. No idea why making API calls is this slow, so i'm just doing the minimum I have to.
* Did I say no JSON ? Sysops/Devops shouldn't have to manually edit attributes.
* Hopefully doesn't look as bad.

Demo
-----

You can try my sample installation at http://chefwebui.pelletiermaxime.info/.
My capistrano config is included as an example of a way to easily deploy it.

Installation
------------

* Clone it
* Composer install
* Configure your knife key location in app/config/packages/jenssegers/config.php
* Use the buildin server (artisan serve) to test
* Have fun!

TODO
----

* Support array fields for databags and node attributes
* Roles
* Environments
