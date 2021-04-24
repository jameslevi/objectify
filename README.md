# Objectify

![](https://img.shields.io/badge/packagist-v1.0.0-informational?style=flat&logo=<LOGO_NAME>&logoColor=white&color=2bbc8a) ![](https://img.shields.io/badge/license-MIT-informational?style=flat&logo=<LOGO_NAME>&logoColor=white&color=2bbc8a)

Is a simple data to object wrapper library in PHP.

## Installation ##
1. You can install via composer.
```
composer require jameslevi/objectify
```
2. If not using any framework, include the composer autoload mechanism at the upper section of your code.
```php
<?php

if(file_exists(__DIR__.'/vendor/autoload.php'))
{
    require __DIR__.'/vendor/autoload.php';
}
```
3. Import the objectify class.
```php
<?php

use Graphite\Component\Objectify\Objectify;
```
## Getting Started ##
1. Instantiate a new objectify class.
```php
$data = new Objectify([
  'x' => 0,
  'y' => 0,
  'z' => 1,
]);
```
2. You can access each data using get method.
```php
echo $data->get("x"); // Will echo the value of x.
```
3. You can also retrieve data as an object property.
```php
echo $data->x; // Will echo the value of x.
```
4. You can also update values of each data.
```php
$data->x = 100;

echo $data->x; // Will echo the new value of x.
```
5. You can add new data using add method.
```php
$data->add("pi", 3.14);
```
6. You can also check if data object contains keyword.
```php
if($data->has("x"))
{
    echo "Object contains x.";
}
```
7. You can remove data from the data object.
```php
$data->remove("z"); // This will remove z from the data object.
```
8. You can return all data object keys.
```php
var_dump($data->keys()); // This will display all data object keys.
```
9. To retrieve the object data, just use the toArray method.
```php
var_dump($data->toArray()); // This will display all the data from the data object.
```
10. You can also return JSON formatted data.
```php
echo $data->toJson(); // This will display the data in json format.
```
## Locked Data Object ##
Adding,updating or deleting of data is disabled when data object is locked.
```php
$data = new Objectify(["x" => 0], true);

$data->x = 1; // Updating value is disabled.
$data->add("y", 1); // Adding new data is disabled.
$data->remove("x"); // Removing existing data is disabled.
```
## Cloning Data Object ##
You can create multiple copies of data object using clone method.
```php
$new_data = $data->clone(); // This will create an exact copy of the data object.
```
## Contribution ##
For issues, concerns and suggestions, you can email James Crisostomo via nerdlabenterprise@gmail.com.
## License ##
This package is an open-sourced software licensed under [MIT](https://opensource.org/licenses/MIT) License.
