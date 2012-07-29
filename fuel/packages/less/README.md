Fuel PHP LESS Package v.1
=====================

LESS Package is a port of Leaf Corcoran's [KO3 Less](https://github.com/mongeslani/kohana-less) for Fuel

You might also want to check out another implementation from [KO3 Less](https://github.com/mongeslani/kohana-less).

To Use
-------
1. Put the less folder in your packages directory
2. Include less package in your application config: 'packages' => array('less')
3. Copy the less config file from /packages/less/config/less.php to your application's config directory
4. From your less.php config file, put the 'path' to where you want the CSS files compiled / compressed, the folder must be writable
5. You can set 'compress' to TRUE on your less.php config file if you want your CSS files to be combined in to one file and compressed (to lessen server calls)



Sample Code
------------




** DOCROOT/assets/less/layout.less **

		@bodyBkgColor: #EEE;

		body {
			background: @bodyBkgColor;
			margin:0;
			padding:0;

			h1 { font-size: 3em; }
		}

** APPPATH/config/less.php **

		return array(
			// relative PATH to a writable folder to store compiled / compressed css
			// path below will be treated as: DOCROOT . 'media/css/'
			'path'     => 'assets/css/',
			'compress' => TRUE,
		);

** APPPATH/classes/controller/sample.php **

		class Controller_Sample extends Controller_Template {

			public $template = 'template';

			public function action_index()
			{
				// no need to add .less extension
				// you can put your less files anywhere
				$less_files = array
				(
					DOCROOT.'assets/less/layout'
				);

				$this->template->stylesheet = Less::compile($less_files);
			}
		}

** APPPATH/views/template.php **

		<html>
		<head>
			<title>LESS for Fuel PHP</title>
			<?php echo $stylesheet; // will give me ONE compressed css file located in /media/css/ ?>
		</head>
		<body>
                ...

