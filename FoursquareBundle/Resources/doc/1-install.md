## 1. Installation
Add DdnetFoursquareBundle to your composer.json file accordingly.
```js
{
  "require": {
    "ddnet/foursquare-bundle": "*"
  }
}
```
Now use composer to add the bundle to your application.
```bash
$ php composer.phar update ddnet/foursquare-bundle
```
Composer will place the bundle in the `vendors/ddnet` directory.

#### Enable Bundle
Enable the bundle within the kernel.
```php
<?php // app/AppKernel.php
  public function registerBundles() 
  {
    $bundles = array(
      // ...
      new Ddnet\FoursquareBundle(),
    );
  }
```