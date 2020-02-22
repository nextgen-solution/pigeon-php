# Pigeon
[![Build Status](https://travis-ci.com/nextgen-solution/pigeon-php.svg?branch=master)](https://travis-ci.com/nextgen-solution/pigeon-php)

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at scelerisque nibh. Phasellus eget est dui. Proin sem velit, laoreet sed dignissim vitae, porta vel felis. Etiam risus magna, consectetur eget ipsum ac, dignissim suscipit tellus. Nullam et egestas mi. Sed at risus at nunc fringilla sagittis ac viverra arcu. Sed nibh nibh, imperdiet vel arcu vitae, finibus ultricies nisi. Suspendisse consectetur eros sit amet scelerisque dapibus.

## Installation

```bash
composer require nextgen-solution/pigeon-php
```

## Usage

```php
use NextGenSolution\Pigeon\Pigeon;

$pigeon = new Pigeon('pigeon-token');
$pigeon->sendMail('example@email.com', 'Test subject', 'Test content');
```
