[![SymfonyInsight](https://insight.symfony.com/projects/fab1a89a-91e1-4fd9-941f-7b86d8a98349/mini.svg)](https://insight.symfony.com/projects/fab1a89a-91e1-4fd9-941f-7b86d8a98349)

README
======

Installation
------------

Install `JcidLocoBundle` using Composer.

```
$ composer require jcid/loco-bundle
```

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Jcid\Bundle\LocoBundle\JcidLocoBundle(),
    );
}
```

Usage
-----

Configuration example

``` 
jcid_loco:
    key:      <Your api key>
    locales:
        nl:   nl_NL
        en:   en_US
        de:   de_DE
    domains:
        -     email
        -     messages
        -     validators
```

After that you could download your translations with the Symfony2 command

```
php app/console translation:loco:download
```
