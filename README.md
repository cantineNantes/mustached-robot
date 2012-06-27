# Mustached Robot

## Installation

### Set up your vhost

* Set up your local vhost to mustached.local
* Set the environment variable ENVTYPE to "development" or "production" ```SetEnv ENVTYPE development	``` (see http://docstore.mik.ua/orelly/linux/apache/ch04_06.htm)
* Set up a database called mustached (check application/config/development/database.php to get the full configuration)

## Developers

### General syntax

As we are using Codeigniter, we follow their [coding style](http://codeigniter.com/user_guide/general/styleguide.html).

### Modules

We use CodeIgniter's [Modular Extensions HMVC](https://bitbucket.org/wiredesignz/codeigniter-modular-extensions-hmvc/wiki/Home). It means the code is grouped into modules. Each module follow the same architecture :

<pre>
|- module_1
|       |_ controllers
|       |_ views
|       |_ models
|       |_ config
|- module_2
|       |_ controllers
|       |_ views
|       |_ config
</pre>

### Models

We use [Datamapper](http://datamapper.wanwizard.eu/) ORM. 

Tip: To load a model of a module from another module, use ```Datamapper::add_model_path( array( APPPATH.'modules/[module_name]') ); in the controller.

### Database ###

Here we will specify where is the database schema and how we handle migrations.

### Templates

We use Sensio Lab's [Twig](http://twig.sensiolabs.org) as a template engine. 

### Controllers 

Controllers must extend one of the following controller : Public_Controller or Admin_Controller (both available in /application/core). 

To call a view from within a controller, just call ```$this->_render('template_name');``` (without .html.twig extension). This will call the template called 'template_name.html.twig' located in the views directory of the same module.

### Views 

Views are located in the view directory of the module. You must name the views with .html.twig extension

Layouts and shared views are located in application/views/

### Assets

Assets are located in the /assets directory. You can use .less for css and .coffee for javascript (just use the .less or .coffee extension). Conventional css (.css extension) or javascript (.js extension) will also work.

The javascript and css assets are minified, stored in the /assets/cache directory and sent on the browser. They are generated on-the-fly if on the the files has been modified. 

## Project status

### User

A visitor can register and login :

* [Register](http://mustached.local/user/register)
* [Login](http://mustached.local/logger/front)

Todo next :

* Tweet with the coworking space account when the user logs in
* Add skills to the user profiles
* Allow users to login on their private account and update their information

### Admin

* [Show a list of the logs per day](mustached.local/admin/logger)

Todo :

* Create admin accounts
* Access to statistics / timeline

### Dashboard

Todo :

* Create the public coworker dashboard
* Create the public calendar dashboard
