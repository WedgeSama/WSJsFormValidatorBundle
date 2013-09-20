WSJsFormValidatorBundle Installation
==================================

## Prerequisites

This bundle requires 
- Symfony 2.3+.

## Installation

### Step 1: Download WSJsFormValidatorBundle using composer

Add WSJsFormValidatorBundle in your composer.json:

```js
{
    "require": {
        "wedgesama/js-form-validator-bundle": "dev-master"
    }
}
```

Now tell composer to download the bundle with this command:

``` bash
$ php composer.phar update wedgesama/js-form-validator-bundle
```

### Step 2: Enable the bundle

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new WS\JsFormValidatorBundle\WSJsFormValidatorBundle(),
    );
}
```
