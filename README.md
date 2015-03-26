#EasySlug

##Description
EasySlug is very simple class to making slug from base text.

##Instalation
Using Composer, just require the pyton/easyslug package:

```json
{
    "require": {
        "pyton/easyslug": "~1.0"
    }
}
```

##Usage
```php
$easySlug = new EasySlug();

$string = 'Base Slug string.';
$slug = $easySlug->create($string);

echo $slug->plain() . PHP_EOL;
// base-slug-string

echo $slug->format('%s.html') . PHP_EOL;
// base-slug-string.html

$easySlug->setReplacement('_');
$slug = $easySlug->create($string);
echo $slug->plain() . PHP_EOL;
// base_slug_string

echo $slug->format('%s.html') . PHP_EOL;
// base_slug_string.html
```

##Usage by static
```php

use EasySlug\EasySlug as Slug;

$string = 'Base Slug string.';


echo Slug::get($string) . PHP_EOL;
// base-slug-string

echo Slug::get($string)->format('%s.html') . PHP_EOL;
// base-slug-string.html


echo Slug::get($string, '_') . PHP_EOL;
// base_slug_string

echo Slug::get($string, '_')->format('%s.html') . PHP_EOL;
// base_slug_string.html
```

##Credits
Łukasz Piotrowski <lukasz@piotrows.pl>
