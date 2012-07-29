# Mustached Robot

## Installation

### Set up your vhost

* Set up your local vhost to mustached.local 
* Configure your vhost so :
** mustached.local points to /mustached/public
** set up the environment variable FUEL_ENV to "development" or "production" ```SetEnv ENVTYPE development	``` (see http://docstore.mik.ua/orelly/linux/apache/ch04_06.htm)

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

* Edit the /fuel/config/mustached.php file :

  * salt : set a unique string (the more complex, the better). This string will be used to encrypt user password and should not be revelad
  * seats : set the number of seats available in the coworking space

* Edit the /fuel/modules/calendar/config/calendar.php file :
  * login and password to connecter your Google Calendar

## Developers

### General syntax

As we are using [FuelPHP](), we follow their [coding standards](http://docs.fuelphp.com/general/coding_standards.html).

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

### Database ###

Here we will specify where is the database schema and how we handle migrations.

### Templates

We use Sensio Lab's [Twig](http://twig.sensiolabs.org) as a template engine.

### Controllers

Controllers must extend one of the following controller : \Front_Controller, \Admin_Controller or \API_Controller (both available in /application/core).

To call a view from within a controller, just call ```return $this->_render('template_name');``` (without .twig extension). This will call the template called 'template_name.twig' located in the views directory of the same module.

### Views

Views are located in the view directory of the module. You must name the views with .twig extension

Layouts and shared views are located in application/views/

### Assets

Assets are located in the /public/assets directory.

#### Less

Less files are located in /public/assets/less directory. They are loaded in the application in the /fuel/app/classes/controller/base.php file. These .less files are generated on the fly if they have been modified in the /public/assets/css/ directory.

If you want to add a new .less file, you need to :
* add it in the /public/assets/less directory
* load it in the /fuel/app/classes/controller/base.php

And that's it !

#### Javascript

Javascript files are stored in the /public/assets/js directory. They are loaded in the fuel/app/views/app.twig (at theend of the document).

## Project status

You can see the project status on the [Github issues tracker](https://github.com/cantineNantes/mustached-robot/issues?milestone=1&state=open)

## DATABASE
