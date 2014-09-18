# Fuel Dependency

[![Latest Stable Version](https://poser.pugx.org/indigophp/fuel-dependency/v/stable.png)](https://packagist.org/packages/indigophp/fuel-dependency)
[![Total Downloads](https://poser.pugx.org/indigophp/fuel-dependency/downloads.png)](https://packagist.org/packages/indigophp/fuel-dependency)
[![License](https://poser.pugx.org/indigophp/fuel-dependency/license.png)](https://packagist.org/packages/indigophp/fuel-dependency)

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


## Contributing

Please see [CONTRIBUTING](https://github.com/indigophp/fuel-dependency/blob/develop/CONTRIBUTING.md) for details.


## Credits

- [Márk Sági-Kazár](https://github.com/sagikazarmark)
- [All Contributors](https://github.com/indigophp/fuel-dependency/contributors)


## License

The MIT License (MIT). Please see [License File](https://github.com/indigophp/fuel-dependency/blob/develop/LICENSE) for more information.
