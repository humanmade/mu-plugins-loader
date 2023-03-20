# MU Plugins Loader

A composer based must-use plugin loader for WordPress.

## Installation

```
composer require humanmade/mu-plugins-loader
```

## Usage

The package a few options for configuration:

### `composer.json`

The package will read your `composer.json` file during the autoload dump step of an installation for 2 configuration options:

* `extra.mu-plugins`: an array of paths relative to your mu-plugins directory
* `extra.mu-plugins-path`: a string path to your mu-plugins directory, only required if different to `wp-content/mu-plugins`
