# Fuel Dependency

[![Packagist Version](https://img.shields.io/packagist/v/indigophp/fuel-dependency.svg?style=flat-square)](https://packagist.org/packages/indigophp/fuel-dependency)
[![Total Downloads](https://img.shields.io/packagist/dt/indigophp/fuel-dependency.svg?style=flat-square)](https://packagist.org/packages/indigophp/fuel-dependency)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)

**This package is a wrapper around [fuelphp/dependency](https://github.com/fuelphp/dependency) package.**


## Install

Via Composer

``` json
{
    "require": {
        "indigophp/fuel-dependency": "@stable"
    }
}
```


## Usage

Let's make this clear: this is pretty much an anti-pattern.

This package backports the v2 Dependency Container and makes it usable the old way. The main purpose of this project is to help developers moving their applications from v1 to v2 by preparing them with service providers, etc. However the static, but not fully stateless logic that is used in v1 (and used by this library) is not real Dependency Injection.

**IMPORTANT:** DC lives inside fuel scope. This means you should not mix it with PSR autoloading. Always use it inside fuel.


## Contributing

Please see [CONTRIBUTING](https://github.com/indigophp/fuel-dependency/blob/develop/CONTRIBUTING.md) for details.


## Credits

- [Márk Sági-Kazár](https://github.com/sagikazarmark)
- [All Contributors](https://github.com/indigophp/fuel-dependency/contributors)


## License

The MIT License (MIT). Please see [License File](https://github.com/indigophp/fuel-dependency/blob/develop/LICENSE) for more information.
