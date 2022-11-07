# Coffee machine

https://simcap.github.io/coffeemachine/cm-first-iteration.html

## Use cases

**1st iteration**
- The drink maker should receive the correct instructions for my coffee / tea / chocolate order
- I want to be able to send instructions to the drink maker to add one or two sugars
- When my order contains sugar the drink maker should add a stick (touillette) with it

**2nd iteration**
- The drink maker should make the drinks only if the correct amount of money is given 
- If not enough money is provided, we want to send a message to the drink maker. The message should contains at least the amount of money missing.

## App

From a demo app using [FrankenPHP](https://frankenphp.dev) that uses Symfony.

## Installation

### Composer

Install composer dependencies:

```
docker run --rm -it -v $PWD:/app composer:latest install --ignore-platform-req=php
```

Or if you have composer installed locally:

```
composer install --ignore-platform-req=php
```

### The project

Run the project with Docker (worker mode):

```
docker run \
    -e FRANKENPHP_CONFIG="worker ./public/index.php" \
    -v $PWD:/app \
    -p 80:80 -p 443:443 \
    dunglas/frankenphp
```

**PS**: Docker is optional; you can also compile
[FrankenPHP](https://github.com/dunglas/frankenphp/blob/main/docs/compile.md)
by yourself.

```
symfony serve
```
