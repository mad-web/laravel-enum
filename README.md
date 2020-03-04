# Elegant Enum implementation for Laravel

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![StyleCI][ico-style]][link-style]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

Based on [MyCLabs PHP Enum](https://github.com/myclabs/php-enum) and implements [SplEnum](http://php.net/manual/ru/class.splenum.php) interface.

You could find documentation for base features in [PHP Enum Readme](https://github.com/myclabs/php-enum/blob/master/README.md).

Features:

- `make:enum` command
- ability to cast enum fields for Eloquent models
- labels translation via lang files
- simple validation rule

## Simple Enum Example

```php
namespace App\Enums;

use MadWeb\Enum\Enum;

/**
 * @method static PostStatusEnum FOO()
 * @method static PostStatusEnum BAR()
 * @method static PostStatusEnum BAZ()
 */
final class PostStatusEnum extends Enum
{
    const __default = self::PENDING;

    const PUBLISHED = 'published';
    const PENDING = 'pending';
    const DRAFT = 'draft';
}
```

## Installation

You can install the package via composer:

```bash
composer require mad-web/laravel-enum:^1.0
```

## Usage

Make new Enum class via artisan command:

```bash
php artisan make:enum PostStatusEnum
```

to populate Enum with your own values, pass it after `name` argument:

```bash
php artisan make:enum PostStatusEnum DRAFT=draft PENDING=pending PUBLISHED=published
```

Create instance of Enum class

``` php
$status = new PostStatusEnum(PostStatusEnum::PENDING);

// or just use magic static method
$status = PostStatusEnum::PENDING();
```

In order to use enum values with Eloquent models you could use `EnumCastable` trait.

```php
class Post extends Model
{
    use EnumCastable;

    protected $fillable = ['title', 'status'];

    protected $casts = [
        'status' => PostStatusEnum::class,
    ];
}
```

after that you could get and set enum field using enum classes

```php
$post = Post::first();

$status = $post->status; // PostStatusEnum

$post->status = PostStatusEnum::PENDING();

$post->save();
```

### Enum values labels (Localization)

Create `enums.php` lang file and declare labels for enum values

```php
// resources/lang/en/enums.php

return [
    PostStatusEnum::class => [
        PostStatusEnum::PENDING => 'Pending Label',
        PostStatusEnum::PUBLISHED => 'Published Label',
        PostStatusEnum::DRAFT => 'Draft Label',
    ],
];
```

and get a label

```php
PostStatusEnum::PENDING()->label(); // Pending Label
```

---

To override default enum lang file path, publish `laravel-enum` config

```bash
php artisan vendor:publish --provider=MadWeb\\Enum\\EnumServiceProvider
```

and change `lang_file_path` option

```php
// config/enum.php

return [
    'lang_file_path' => 'custom.path.to.enums',
];
```

### Validation Rule

You may validate an enum value from a request by using the `EnumRule` class or `Enum::rule()` method.

``` php
public function store(Request $request)
{
    $this->validate($request, [
        'status' => ['required', new EnumRule(PostStatusEnum::class)],
    ]);

    // OR

    $this->validate($request, [
        'status' => ['required', PostStatusEnum::rule()],
    ]);
}
```

If you want to validate an enum key instead of an enum value you can by specifying you want to validate against the key 
instead of the value.

``` php
public function store(Request $request)
{
    $this->validate($request, [
        'status' => ['required', new EnumRule(PostStatusEnum::class, true)],
    ]);

    // OR

    $this->validate($request, [
        'status' => ['required', PostStatusEnum::ruleByKey()],
    ]);
}
```
 
---

To customize validation message, add `enum` key to validation lang file

```php
// resources/lang/en/validation.php
    ...
    'email' => 'The :attribute must be a valid email address.',
    'enum' => 'Custom validation message form enum attribute :attribute', // Custom message
    'exists' => 'The selected :attribute is invalid.',
    ...
```

## Additional methods

### getRandomKey(): string

Returns a random key from the enum.

```php
PostStatusEnum::getRandomKey(); // Returns 'PUBLISHED` or `PENDING` or `DRAFT`
```

### getRandomValue()

Returns a random value from the enum.

```php
PostStatusEnum::getRandomValue(); // Returns 'published` or `pending` or `draft`
```

### label(): string

Returns label for the enum value object

```php
PostStatusEnum::PUBLISHED()->label(); // Returns 'published` or custom label declared in a lang file
```

### labels(): array

Returns all labels for a enum

```php
PostStatusEnum::labels(); // Returns ['published`, 'pending', 'draft'] or array of custom labels declared in a lang file
```

### is($value): bool

Checks whether the current enum value is equal to a given enum

```php

$status = PostStatusEnum::PENDING();


PostStatusEnum::PUBLISHED()->is($status); // false

PostStatusEnum::PENDING()->is($status); // true

// or

PostStatusEnum::PUBLISHED()->is($status->getValue()); // false

PostStatusEnum::PENDING()->is($status->getValue()); // true

// or check one of multiple values

$status->is([PostStatusEnum::DRAFT(), PostStatusEnum::PUBLISHED()]) // false

$status->is([PostStatusEnum::DRAFT(), PostStatusEnum::PENDING()]) // true
```

### rule(): EnumRule

Returns instance of validation rule class for the Enum

```php
PostStatusEnum::rule(); // new EnumRule(PostStatusEnum::class);
```

### getConstList(bool $include_default = false): array

Returns all consts (possible values) as an array according to [SplEnum::getConstList](http://php.net/manual/en/splenum.getconstlist.php)

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please email madweb.dev@gmail.com instead of using the issue tracker.

## Credits

- [Mad Web](https://github.com/mad-web)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/mad-web/laravel-enum.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/mad-web/laravel-enum/master.svg?style=flat-square
[ico-style]: https://styleci.io/repos/138497948/shield
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/mad-web/laravel-enum.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/mad-web/laravel-enum.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/mad-web/laravel-enum.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/mad-web/laravel-enum
[link-travis]: https://travis-ci.org/mad-web/laravel-enum
[link-style]: https://styleci.io/repos/138497948
[link-scrutinizer]: https://scrutinizer-ci.com/g/mad-web/laravel-enum/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/mad-web/laravel-enum
[link-downloads]: https://packagist.org/packages/mad-web/laravel-enum
[link-author]: https://github.com/mad-web
[link-contributors]: ../../contributors
