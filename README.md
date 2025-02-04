This library makes it easier to use functional style programming in PHP. 

## IMPORTANT:
This library is a fork of the original Revinate/Sequence library https://github.com/revinate/sequence. 
This fork is intended to upgrade the library to be compatible with PHP 8.1 version.

## PHP Backward Compatibility
As we move our codebase forward, it is no longer possible for us to support older versions of PHP.
With release version 1.0 and onward, we will stop supporting PHP 5.3 and PHP 5.4.

## Quick Example

Install the package via composer by executing the following command:

```Bash
composer require jorgezf/sequence
```

This is a tiny script to get a feeling of how Sequence works.

```php
<?php
require_once __DIR__.'/vendor/autoload.php';

use Revinate\Sequence\Sequence;

$dataSet = [1, 2, 3, 4, 5];
$seq = Sequence::make($dataSet);

// At this point you have a sequence and you can do bunch of cool sequence stuff with it

$even = $seq->filter(static function($n) { return $n%2 == 0; });  // nothing is evaluated here because of lazy loading
foreach($even as $num) {
    echo "$num\n";
}


$twice = $seq->map(static function($n) { return $n * 2; });
foreach($twice as $num) {
    echo "$num\n";
}
```

and the output of this program will be:

    2
    4
    2
    4
    6
    8
    10

This is just a tiny bit of all the things that can be accomplished with Sequence.
For a more detailed documentation, see [Wiki](https://github.com/revinate/sequence/wiki/Sequence-Functional-Library)

## How to get involved

First clone the repo and install the dependencies

```Bash
git clone https://github.com/jorgezf/sequence.git
composer install
```

and then run the tests:

```Bash
./vendor/bin/phpunit
```

That's all you need to start working on Sequence. Please, include tests in your pull requests.