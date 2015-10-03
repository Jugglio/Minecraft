# Laravel Minecraft

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Software License][ico-license]](LICENSE.md)

This is a simple package providing you with all the tools to quickstart
development on that Minecraft site you've been craving. Retrieve UUIDs based
on usernames or the other way around with a simple and human-readable API.

## Install

Via [composer](http://getcomposer.org):

```bash
$ composer require juggl/minecraft
```

Once that's done, you can add the `MinecraftServiceProvider` to your
`providers` array, and the `Minecraft` alias to the `aliases` array in
`/config/app.php`:

```php
'providers' => [
    ...
    Juggl\Minecraft\MinecraftServiceProvider::class,
];
```

```php
'aliases' => [
    ...
    'Minecraft' => Juggl\Minecraft\Facades\Minecraft::class,
];
```

## Usage

```php
// Retrieves a UUID (without dashes) based on the username provided.
Minecraft::getUuidFromName($username);

// Supply an optional UNIX timestamp to get the UUID of the user who owned that
// name at that time.
Minecraft::getUuidFromName($username, time() - (365 * 24 * 60 * 60));

// Get array of names the user has played as.
Minecraft::getNameHistory($uuid);

// Extract current username from UUID provided.
Minecraft::getNameFromUuid($uuid);

// Get array of objects with info about each user (username & UUID).
Minecraft::getUuidsFromNames(['Notch', 'jeb_', 'Dinnerbone']);
```

## Rate limiting

Mojang has somec rate limiting in place so you are expected to cache the
results! everything in this package, the limit is **600 requests every 10
minutes**. Keep in mind Mojang might change this at any time.

## Credits
This is simply a wrapper around [Mojang](https://mojang.com)'s API, beautifully
(yet unofficially) documented at http://wiki.vg/Mojang_API.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/juggl/minecraft.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-green.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/juggl/minecraft.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/juggl/minecraft
[link-downloads]: https://packagist.org/packages/juggl/minecraft
