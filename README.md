README
======

Installation
------------

Add bundle in your composer.json:

```js
{
    "require": {
        "jcid/loco-bundle": "dev-master"
    }
}
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