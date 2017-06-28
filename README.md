[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/kouinkouin/street-parser/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/kouinkouin/street-parser/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/kouinkouin/street-parser/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/kouinkouin/street-parser/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/kouinkouin/street-parser/badges/build.png?b=master)](https://scrutinizer-ci.com/g/kouinkouin/street-parser/build-status/master)

# StreetParser  

A PHP library to split an address street to street name, number, box, ...

## Installation

```console
$ composer require kouinkouin/street-parser
```


## Usage

```php
require __DIR__ . '/vendor/autoload.php';

use kouinkouin\StreetParser\StreetParser;

$streetParser = new StreetParser();
$street = $streetParser->getStreetDataFromFullStreet('Rue du grand Duc, 13/B1');
var_dump($street->getName()); // string(16) "Rue du grand Duc"
var_dump($street->getNumber()); // string(2) "13"
var_dump($street->getBox()); // string(2) "B1"
```
