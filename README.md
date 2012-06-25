# Mustached Robot

## Installation

### Set up your vhost

* Set up your local vhost to mustached.local
* Set the environment variable ENVTYPE to "development" or "production" ```SetEnv ENVTYPE development	``` (see http://docstore.mik.ua/orelly/linux/apache/ch04_06.htm)
* Set up a database called mustached (check application/config/development/database.php to get the full configuration)

## Developers

### Modules

We use CodeIgniter's [Modular Extensions HMVC](https://bitbucket.org/wiredesignz/codeigniter-modular-extensions-hmvc/wiki/Home). It means the code is grouped into modules. Each module follow the same architecture :

<pre>
|- module_1
|       |_ controllers
|       |_ views
|       |_ config
|- module_2
|       |_ controllers
|       |_ views
|       |_ config
</pre>

### Templates

We use Sensio Lab's [Twig](http://twig.sensiolabs.org) as a template engine. 

### Controllers 

Controllers must extend MX_Controller. To call a view from within a controller, just call ```$this->_render('template_name');``` (without .html.twig extension). This will call the template called 'template_name.html.twig' located in the views directory of the same module.

### Views 

Views are located in the view directory of the module. You must name the views with .html.twig extension

Layouts are located in application/views/

### Assets

Assets are located in the /assets directory. You can use .less for css ans .coffeescript for javascript (just use the .less or .coffeescript extension). Conventional css (.css extension) or javascript (.js extension) will also work.




