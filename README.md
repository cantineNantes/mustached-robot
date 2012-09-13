# Mustached Robot

!! COWORKING WEEK-END SPECIAL !!

[We have a special page dedicated to the Coworking WeekEnd Hackaton](https://github.com/cantineNantes/mustached-robot/wiki/Coworking-week-end), please read it if you want to get involved !

## Description

Mustached Robot is an open source checkin plateform for coworking spaces. The project started in [Nantes]((http://goo.gl/maps/BNA73) and is currently under development.

## Development team

* Florent Gosselin - UX designer ([@fgosselin](http://twitter.com/fgosselin))
* Jérémie Pottier - Developer ([@dzey](http://twitter.com/dzey))

## Roadmap


### Beta version (early september)

* Coworkers can create, update and delete their account
* Coworkers can checkin in the coworking space
* Dashboard view with the coworkers profiles and the next events in the coworking space (this view can be used on a large TV screen in the coworking space)
* Administrators can access the coworking space datas (coworkers currently here, coworkers profiles, coworking space statistics)
* Developers can access the coworking space information via an API (to allow integration with coworking space websites for example)
* Mobile ready

### V1

* Plugin system to allow anyone to develop plugins without needing to change the core files (example: a billing management system through Freshbook, a connection to a specific CRM, etc)

## Installation

If you want to install Mustached Robot, just follow these instructions:

### Download the source files

This one should be easy.

### Allow theses directories to be writable

* /public/assets/css
* /fuel/app/cache/
* /fuel/app/cache/twig

### Set up your vhost

* Set up your local vhost to mustached.local 
* Configure your vhost so :

  * mustached.local points to /mustached/public
  * set up the environment variable FUEL_ENV to "development" or "production" ```SetEnv FUEL_ENV development	``` (see http://docstore.mik.ua/orelly/linux/apache/ch04_06.htm)

Vhost example : 

```
<VirtualHost *:80>
        DocumentRoot "/Users/dzey/www/mustached-robot/public"
        ServerName mustached.local
		SetEnv FUEL_ENV development		
</VirtualHost>
```

### Database

#### Configuration 

* Set up the database name and connection login / passwords (check fuel/app/config/development/db.php to get the full configuration, or edit the file)

### Populate your database

* Before starting you should populate the database with the file database.sql located on the root
* Please note that in this file, one table has been populated : the "reasons" table. You can change the values of the different entries or add new ones, but the entry with id = 1 is, by convention, for coworking.

### Configuration

* Edit the fuel/app/config/mustached.php file :

  * seats : set the number of seats available in the coworking space

* Edit the fuel/modules/calendar/config/calendar.php file :
  * login and password to connect to your Google Calendar

* Edit the fuel/app/config/simpleauth.php file :
  * login_hash_salt : set a unique string (the more complex, the better). This string will be used to encrypt user password and should not be revelad nor changed


### API Access

If you want to enable an API access to external developers, you need to configure the login / password of the developers you want to allow in /fuel/app/config/rest.php -- set the 'valid_logins' array :

```
	'valid_logins' => array('developer1' => '1234', 'developer2' => '5678'),
```

### Create an admin user

* You first need to create a user by registering the user on http://mustached.local/user/account/add
* Then, in the database, set the "group" field of this user to 100 (it means you will be an admin)

## Developers

Mustached Robot is developed with [FuelPHP](http://fuelphp.com). You should be familiar with this framework to start working on Mustached Robot. The [documentation](http://docs.fuelphp.com/) is nice and easy to work with.

### Contributors

New developers or designers are welcome to join the project. Just contact us on twitter ([@fgosselin](http://twitter.com/fgosselin), [@dzey](http://twitter.com/dzey)) if you want to get involved !

### Coding standards

As we use [FuelPHP](http://fuelphp.com), we follow their [coding standards](http://docs.fuelphp.com/general/coding_standards.html).

### Modules

We use FuelPHP's [Modules] (http://docs.fuelphp.com/general/modules.html). It means the code is grouped into modules. Each module follow the same architecture :

<pre>
|- module_1
|       |_ classes
|            |_ controller
|            |_ model
|            |_ single_class.php
|       |_ views
|       |_ config
|- module_2
|       |_ classes
|            |_ controller
|            |_ model
|            |_ other_class.php
|       |_ views
|       |_ config
</pre>

### Templates

We use Sensio Lab's [Twig](http://twig.sensiolabs.org) as a template engine.

### Controllers

Controllers must extend one of the following controller : \Front_Controller, \Admin_Controller or \API_Controller ( available in /application/core).

The Front_controller is used to display information for a public user 
The Admin_Controller

To call a view from within a controller, just call ```return $this->_render('template_name');``` (without the .twig extension). This will call the template called 'template_name.twig' located in the views directory of the module.

### Users

We use FuelPHP's [SimpleAuth package](http://docs.fuelphp.com/packages/auth/simpleauth/intro.html) to handle authentication.

In each controller, you have access to a variable called current_user. If this variable is set, it means a user is logged in. You also have access to some variables :

* user_id 
* firstname
* email
* group : this is the group the user belongs to. See [SimpleAuth documentation](http://docs.fuelphp.com/packages/auth/simpleauth/intro.html) -- basically : group = 100 means it is an admin and group = 1 means it's a simple user 

You can access to this datas in the Controller : 

* $this->current_user['user_id']
* $this->current_user['firstname']
* $this->current_user['group']
* $this->current_user['email']

Or in the templates :

Twig :
* {{ current_user.user_id }}
* {{ current_user.firstname }}
* {{ current_user.group }}
* {{ current_user.email }}

You can also access the user's avatar with the twig function {{ avatar(current_user.email, 40) }} (40 can be replaced by another integer : it is the size of the avatar).

### Views

Views are located in the views directory of the module (NOT the classes/view directory). You must name the views with .twig extension

Layouts and shared views are located in /fuel/app/views/

### Assets

Assets are located in the /public/assets directory.

#### Less

Less files are located in /public/assets/less directory. They are loaded in the application in the /fuel/app/classes/controller/base.php file. These .less files are generated on the fly if they have been modified in the /public/assets/css/ directory.

If you want to add a new .less file, you need to :
* add it in the /public/assets/less directory
* load it in the /fuel/app/classes/controller/base.php

And that's it !

#### Javascript

Javascript files are stored in the /public/assets/js directory. They are loaded in the fuel/app/views/app.twig (at the end of the document).



## Project status

You can see the project status on the [Github issues tracker](https://github.com/cantineNantes/mustached-robot/issues?milestone=1&state=open)
