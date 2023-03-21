# MU Plugins Loader

A composer based must-use plugin loader for WordPress.

This package is a simple composer plugin that creates a file called `loader.php` in your MU plugins directory that automatically includes the plugin and files you specify.

This is useful if you want to organise and load MU plugins from a subdirectory of the mu plugins folder, as WordPress does not do this automatically.

## Installation

```sh
composer require humanmade/mu-plugins-loader
```

## Usage

The package a few options for configuration:

### Using `composer.json`

The package will read your `composer.json` file during the autoload dump step of an installation for 2 configuration options:

* `extra.mu-plugins`: an array of paths relative to your mu-plugins directory
* `extra.mu-plugins-path`: a string path to your mu-plugins directory
   * **note**: this is _only_ required if you don't specify a different path under the `installer-paths` configuration and also different to `wp-content/mu-plugins`

Example:

```json
{
    "extra": {
        "mu-plugins": [
            "authorship/plugin.php"
        ],
        "installer-paths": {
            "/content/mu-plugins/{$name}/": {
                "humanmade/authorship",
                "type:wordpress-muplugin"
            }
        }
    }
}
```

### Using `HM_MU_PLUGINS` constant

If you need to apply some logic or simply prefer to define your MU plugins list in PHP you can ignore the `composer.json` configuration and instead define `HM_MU_PLUGINS` as an array before the loader plugin is included.

The simplest way to do this is to add a mu plugin with an alphabetically lower name and define it there e.g.:

```php
# wp-content/mu-plugins/0000-plugins.php

define( 'HM_MU_PLUGINS', [
    'authorship/plugin.php',
] );
```
