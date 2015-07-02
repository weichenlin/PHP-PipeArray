# PipeArray
the PipeArray provide a way to manipulate array by Collection Pipeline pattern.
although PHP has provide many array_* functions, they are a little annoying to combined together:

```php
$score = [40, 55, 32, 63];

// add bonus and check passed score
$bonusScore = array_map(function($e){ return intval(sqrt($e) * 10); }, $score);
$passedScore = array_filter($bonusScore, function($e){ return $e >= 60; });
```

use the Collection Pipeline pattern are more clear:

```php
$score = [40, 55, 32, 63];

// add bonus and check passed score
$passedScore = Pipe::Start($score)
                ->map(function($e){ return intval(sqrt($e) * 10); })
                ->filter(function($e){ return $e >= 60; })
                ->rawData();
```

Pipe::Start() return a instance of PipeArray which can used as normal array as well as by OO way:

```php
$pArray = Pipe::Start([1, 2, 3, 4, 5]);
$pArray->push(6);
var_dump($pArray[5]); // print 6

$pArray->pop();
var_dump($pArray->count()); // print 5
```

the PipeArray can use like an array, but it's exactly an object.
some array function require real PHP array, you can retrieve it by calling rawData() method:

```php
$phpArray = Pipe::Start(...)->map(...)->rawData();
```

Most array_* functions are available in the PipeArray class, except:
- that didn't generate result from current array, like array_fill
- that require another array as parameter, like array_diff

also the function name has a little change:
- the "array_" part are removed, for example, array_key_exists equals to PipeArray->key_exists()
- it provide camel case method, for example, key_exists() is an aliases for keyExists()

# Install

By Composer:
```json
  "require": {
    "aznc/pipe-array": "^1.0.0"
  }
```
