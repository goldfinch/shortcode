```
/themes/{theme}/templates/Shortcodes/hh.ss
/themes/{theme}/templates/Shortcodes/hr.ss
```

hh.ss
```
<strong>$content</strong>
```
hr.ss
```
<hr>
```

```
[hh] .. [hh][/hh]
[hr]
```


1) (!COMMENTED OUT in _config.php) Auto scan dir /templates/Shortcodes/*.ss (if no allow_shortcodes property defined)

2) More common (optimized approach)

app/_config/shortcodes.yml
```
---
Name: app-shortcodes
---
Goldfinch\Shortcode\Shortcode:
  allow_shortcodes:
    - hh
```
