# Mustached Robot

[![Build Status](https://secure.travis-ci.org/cantineNantes/mustached-robot.png)](http://travis-ci.org/cantineNantes/mustached-robot)

## Description

Mustached Robot is an open source checkin plateform for coworking spaces. The project started in [Nantes]((http://goo.gl/maps/BNA73) and is currently under development.

## Development team

* Florent Gosselin - UX designer ([@fgosselin](http://twitter.com/fgosselin))
* Jérémie Pottier - Developer ([@dzey](http://twitter.com/dzey))

New developers or designers are welcome to join the project. Just contact us on twitter ([@fgosselin](http://twitter.com/fgosselin), [@dzey](http://twitter.com/dzey)) if you want to get involved!

## Roadmap

### Beta version (september)

_The beta version is a completely functional application on its own but a little nerdy to install_

* Coworkers can create an account and checkin in the coworking space
* Coworking space managers can access the coworking space datas on a beautiful dashboards: coworkers currently here, coworkers profiles, coworking space statistics
* A Dashboard view with the coworkers profiles and the next events in the coworking space (this view can be used on a large TV screen in the coworking space)
* An API is available so any allowed developer can play with the coworking space datas
* Mobile ready

### V1

_The V1 is an easy-to-install, easy-to-extend plateform_

* Install wizard (database configuration, google calendar credentials, creation of the first admin user)
* Plugin system to allow anyone to develop plugins without needing to change the core files (example: a billing management system through Freshbook, a connection to a specific CRM, etc).

## Installation

See the [install documentation](https://github.com/cantineNantes/mustached-robot/wiki/Installation)

## Documentation 

You want to get involved? See the [Developers documentation](https://github.com/cantineNantes/mustached-robot/wiki/Developers-documentation)

## API documentation 

An [API mini-doc](https://github.com/cantineNantes/mustached-robot/wiki/API) is also available. Once Mustached Robot is installed and configured on a server, developers can use this API to access the coworking space datas.

## Project status and bug report

You can see the project status or report any bug on the [Github issues tracker](https://github.com/cantineNantes/mustached-robot/issues?milestone=1&state=open)

## Help and discussions

If you need help or if you want to talk about mustaches, you can do it on twitter or on this [Google Group](https://groups.google.com/forum/#!forum/mustached-robot).

## Plugins

-- Plugins are still under development --

You can develop plugins for Mustached Robot. Ouh yeah. A plugin is an independant module which can interact at several strategic places of the application.

With a plugin you can :

 * Add anything you want on a few specific views
 * Add form elements and trigger actions according to these elements on the application

### Develop a plugin

To create a new plugin, add a module in the "/fuel/app/modules" folder. According to the classes and their methods, you will be able to customize Mustached Robot.

Here are the current classes you can use:

* Config
* Form - It allows you to add form elements on some form of the application.
* Trigger - It allows you to do anything you want after a specific action has been done by the user (example: after a user has checked in, I want my plugin to tweet about it and send me a SMS).

### Customizables modules

#### Checkin

* Configure the checkin form : addElementOnPublicCheckin($fieldname, $before_after)
* Do something when a user checks in : postCheckin($fieldset)





