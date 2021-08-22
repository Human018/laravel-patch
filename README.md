<h1 align="center">Laravel Patch</h1>

<p align="center">Perform migrations and database patches within your Laravel application</p>

<hr/>
[![Contributors][contributors-shield]][contributors-url]
[![Forks][forks-shield]][forks-url]
[![Stargazers][stars-shield]][stars-url]
[![Issues][issues-shield]][issues-url]
[![MIT License][license-shield]][license-url]

At times you may need to run a database migration and then perform some kind of patch associated with the migration.
This package will create both the migration and an associated patch command, it will listen for the migration event and 
then run the patch command automatically for you.

### When might you use this package?
####Example 1: 
You're changing a model relationship to an immediate relationship (hasMany) rather than a distant relation 
(hasManyThrough). You need to add a new foreignId column to the target models table and then populate that column with 
the correct ID's. With this package you can create both the migration and the patch command and then run them within the 
same migration command.

##Index
- [Usage](#usage)
    - [Requirements](#requirements)
    - [Download & Installation](#download--installation)
    - [Performing Patches](#performing--patches)
    - [Migration Direction](#migration--direction)
- [License](#license)

##Usage

###Requirements
- PHP 7.4
- Laravel 8

###Download & Installation
```shell
$ composer require human018/laravel-patch
```

Laravel will auto discover the package.

###Performing Patches
Once installed a patch can be created by running the following command in line with the regular Laravel make:migration command.
```shell
$ php artisan make:patch {name} {table|create}
```
This will generate both the migration and an associated patch command. 

The package listens for when a migration event is fired, determines if there is an associated patch command and fires the command.

You will find Patch commands created in your projects 'Commands' folder under the subdirectory 'Patches', where you can perform any tasks that need to be done in line with this migration.

###Migration Direction
The migration direction is passed to the Patch Command using the 'method' option.
```php
$this->input->getOption('method'); // Returns 'up' or 'down'
```
So if you need to revert some changes you can detect the 'down' direction.

##License

This project is licensed under the MIT License
