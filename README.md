
# 🦅 Shortcodes for Silverstripe

[![Silverstripe Version](https://img.shields.io/badge/Silverstripe-5.1-005ae1.svg?labelColor=white&logoColor=ffffff&logo=data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAxMDEuMDkxIDU4LjU1NSIgZmlsbD0iIzAwNWFlMSIgeG1sbnM6dj0iaHR0cHM6Ly92ZWN0YS5pby9uYW5vIj48cGF0aCBkPSJNNTAuMDE1IDUuODU4bC0yMS4yODMgMTQuOWE2LjUgNi41IDAgMCAwIDcuNDQ4IDEwLjY1NGwyMS4yODMtMTQuOWM4LjgxMy02LjE3IDIwLjk2LTQuMDI4IDI3LjEzIDQuNzg2czQuMDI4IDIwLjk2LTQuNzg1IDI3LjEzbC02LjY5MSA0LjY3NmM1LjU0MiA5LjQxOCAxOC4wNzggNS40NTUgMjMuNzczLTQuNjU0QTMyLjQ3IDMyLjQ3IDAgMCAwIDUwLjAxNSA1Ljg2MnptMS4wNTggNDYuODI3bDIxLjI4NC0xNC45YTYuNSA2LjUgMCAxIDAtNy40NDktMTAuNjUzTDQzLjYyMyA0Mi4wMjhjLTguODEzIDYuMTctMjAuOTU5IDQuMDI5LTI3LjEyOS00Ljc4NHMtNC4wMjktMjAuOTU5IDQuNzg0LTI3LjEyOWw2LjY5MS00LjY3NkMyMi40My0zLjk3NiA5Ljg5NC0uMDEzIDQuMTk4IDEwLjA5NmEzMi40NyAzMi40NyAwIDAgMCA0Ni44NzUgNDIuNTkyeiIvPjwvc3ZnPg==)](https://packagist.org/packages/goldfinch/shortcode)
[![Package Version](https://img.shields.io/packagist/v/goldfinch/shortcode.svg?labelColor=333&color=F8C630&label=Version)](https://packagist.org/packages/goldfinch/shortcode)
[![Total Downloads](https://img.shields.io/packagist/dt/goldfinch/shortcode.svg?labelColor=333&color=F8C630&label=Downloads)](https://packagist.org/packages/goldfinch/shortcode)
[![License](https://img.shields.io/packagist/l/goldfinch/shortcode.svg?labelColor=333&color=F8C630&label=License)](https://packagist.org/packages/goldfinch/shortcode) 

A quick way to create custom shortcodes in Silverstripe.

## Install

```bash
composer require goldfinch/shortcode
```

## Available Taz commands

If you haven't used [**Taz**](https://github.com/goldfinch/taz)🌪️ before, *taz* file must be presented in your root project folder `cp vendor/goldfinch/taz/taz taz`

---

> Create new shortcode
```bash
php taz make:shortcode
```

## Use Case example

Let's create a few shortcodes, single **hr** that will display `<hr>` tag and closable **st** that wraps text `<strong>text</strong>` and makes it bold

#### 1. Create shortcodes

```bash
php taz make:shortcode hr
php taz make:shortcode st
```

#### 2. Edit templates

Taz registered our shortcodes for us and created templates `hr.ss` and `st.ss` stored in `our_theme/templates/Shortcodes/`. We can update them as needed.

#### 3. Set DB type

Assuming that we want `Title` in our `DataObject` to support shortcodes, we need to use `SCVarchar` instead of `Varchar`

```php
private static $db = [
    'Title' => 'SCVarchar',
];
```

All done, we now can check the output of `$Title` in our template to see the result.

## License

The MIT License (MIT)
