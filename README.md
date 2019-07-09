# Timber Commented Include

This is a simple port of `djboris88/twig-commented-include` to be used with 
[Timber](https://github.com/timber/timber) for WordPress.

It helps debugging and navigating through
many Twig partials in your project. It outputs a HTML comments before and after each
`include` statement while rendering the template. Comments look like this:

```html
<!-- Begin output of "_partials/_navigation.twig" -->
<div class="navigation" role="navigation" data-navigation>...</div>
<!-- / End output of "_partials/_navigation.twig" -->
```

Installation
------------
To install the latest stable version of this component, open a console and execute the following command:
```bash
composer require djboris88/timber-commented-include --dev
```

Usage
-----
To be able to see the commented output, `WP_DEBUG` has to be defined and set as
`true` in `wp-config.php` file.

The Twig Extension will automatically be registered and applied. If the
WordPress add_filter function is not available when that happens, it will fail.
In that case, you will need to call initialization yourself at an appropriate
time after WordPress itself is initialized:
```php
if (function_exists('\Djboris88\Timber\initialize_filters')) {
  \Djboris88\Timber\initialize_filters();
}
```
