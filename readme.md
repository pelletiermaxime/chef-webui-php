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

* Databags listing and editing
* Nodes listing and attributes listing
* Cookbooks listing

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

* Support array fields
* Editing of existing node attributes
* Editing of node cookbooks
* Roles
