# Objectify

![](https://img.shields.io/badge/packagist-v1.0.3-informational?style=flat&logo=<LOGO_NAME>&logoColor=white&color=2bbc8a) ![](https://img.shields.io/badge/license-MIT-informational?style=flat&logo=<LOGO_NAME>&logoColor=white&color=2bbc8a)

Is a simple data to object wrapper library in PHP.

## Installation
1. You can install via composer.
```
composer require jameslevi/objectify
```
2. If not using any framework, include the composer autoload mechanism at the upper section of your code.
```php
require_once __DIR__.'/vendor/autoload.php';
```
3. Import the objectify class.
```php
use Graphite\Component\Objectify\Objectify;
```
## Getting Started
1. Instantiate a new objectify class.
```php
$data = new Objectify(array(
  "x" => 0,
  "y" => 0,
  "z" => 1,
));
```
2. You can access the value of x using the following methods.
```php
echo $data->get("x");

// or

echo $data->x;
```
3. You can also update the value of x.
```php
$data->set("x", 100);

// or

$data->x = 100;
```
4. You can add new data using add method.
```php
$data->add("pi", 3.14);
```
5. You can also check if data object contains keyword.
```php
$data->has("x") // Returns true.
```
6. You can remove data from the data object.
```php
$data->remove("z"); // This will remove z from the data object.
```
7. You can return all data object keys.
```php
$data->keys(); // This will return all data object keys.
```
8. To retrieve the object data, just use the toArray method.
```php
$data->toArray(); // This will return all the data from the data object in array.
```
9. You can also return JSON formatted data.
```php
$data->toJson(); // This will return json formatted string.
```
## Extend Objectify
1. You can extend objectify to an entity. For this example let's use car as an entity.
```php
<?php

use Graphite\Component\Objectify\Objectify;

class Car extends Objectify
{
    public function setColor(string $color)
    {
        $this->color = $color;
    }
}
```
2. Now let's instantiate a new car object.
```php
$car = new Car(array(
    "manufacturer"          => "Honda",
    "model"                 => "Civic",
    "type"                  => "Sedan",
    "color"                 => "red",
));
```
3. We can now manipulate car object data.
```php
$car->setColor("blue");
```
4. Now let's echo the color of our car.
```php
echo $car->color; // Result will be "blue".
```
## Muted Data Object
Adding, updating or deleting of data is disabled when data object is muted.
```php
$data = new Objectify(array("x" => 0), true);

// All of this methods are freezed.
$data->set("y", 1);
$data->add("y", 1);
$data->remove("x");
```
## Cloning Data Object
You can create multiple copies of data object using clone method.
```php
$new_data = $data->clone();
```
## Contribution
For issues, concerns and suggestions, you can email James Crisostomo via nerdlabenterprise@gmail.com.
## License
This package is an open-sourced software licensed under [MIT](https://opensource.org/licenses/MIT) License.
