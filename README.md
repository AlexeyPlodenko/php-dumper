# php-dumper

## Motivation

Being a lazy developer, I do not want to install XDebug or any other tool. But rather start coding and debugging with the existing setup right now.

The package provides a simple dump function, to output the variables and stop execution.


## Install

Run `composer require alexeyplodenko/php-dumper`

## Usage

```php
<?php
require 'vendor/autoload.php';

d(NULL, 'string', '', 123);
```

Outputs in a browser and CLI:

```
NULL

string

(empty string)

123

#0 E:\web\AlexeyPlodenko\php-dumper\index.php(3): d(NULL, 'string', '', 123)
#1 {main}
```

## Dependencies

No dependencies.
