# Vegan.B

## Goal

Create a backend form that can be only accessible by the admin, which registers the writing events on a chart of your choosing 

## Overview

This sample code gives you an idea to integrate Chart.Js into Adminhtml Magento 2.3.

## Requirements

Magento Open Source (CE) Version 2.3.x

## Installation

Unzip Vegan-B - Magento BO.zip 

Include the package.

```bash
MAGENTO_ROOT/app
```

Enable the module.

```bash
$ php bin/magento module:enable Vegan_Survey
$ php bin/magento setup:upgrade
$ php bin/magento cache:clean
```

## Usage

In the Magento admin, go to the menu item ``` Vegan``` and click on ``` Survey data```. You will be able to add answers to specific questions and references. Then you will be able to view the progress of the responses in a bar chart in  ``` Vegan``` -> ``` Survey Chart```.


# Vegan.C


## Overview

This is a software with PHP that uploads 4 images and saves them on a docker machine as file server 

## Requirements

- php 7.4.16
- nikic/fast-route 1.3,
- guzzlehttp/guzzle 7.2,
- propel/propel ~2.0@dev
- twig/twig ^2.0
- twbs/bootstrap 4.6.*
- symfony/dotenv 5.2.*

## Installation

####Create hosts

#####Windows:
>Open C:\Windows\System32\drivers\etc\hosts

Add the below line at the end of file.

127.0.0.1      http://vegan-c.docker/

#####Ubuntu and MAC:

> sudo vi /etc/hosts

127.0.0.1      http://vegan-c.docker/

####DOCKER

The Docker environment that will be installed contains the following services:

* Nginx
* PHP 7.4.16
* MariaDb


```bash
$ docker-composer up -d
$ docker-compose exec php bash
$ cd /code
$ composer install

```

####PROPEL

Info for propel init procedure:

- MYSQL_ROOT_PASSWORD=root
- MYSQL_DATABASE=test
- MYSQL_USER=root
- MYSQL_PASSWORD=root

```bash
$ ./vendor/propel/propel/bin/propel init 
```

Edit propel.yml:
> add password and remove the comments
```bash
$ cp propel.yml.dist propel.yml
$ vi propel.yml
```

## Usage

Go to [http://vegan-c.docker](http://vegan-c.docker) page and try drag and drop upload and delete images