Pico Sitemap
============

PicoXMLSitemap is a [Pico 1.0-compatible ][1] plugin used to automatically generate a valid [xml sitemap][2].

## Instructions

* Place the `PicoXMLSitemap.php` into your `plugins` directory.

* Browse to `http://yoursite.com/?sitemap.xml` or `http://yoursite.com/sitemap.xml` if you have mod_rewrite enabled.

* Take a break, your work is done!

## Note

* You can also place `$config['PicoXMLSitemap.enabled'] = false;` in your `config/config.php` to disable the plugin.

* The `Date:` YAML header in your `.md` files, and `$config['date_format']` in your `config/config.php` should be in [W3C Datetime][3] format to prevent errors in your `sitemap.xml`. This format allows you to omit the time portion, if desired, and use YYYY-MM-DD.

    For more information see: [sitemaps.org][4]

[1]: http://picocms.org/
[2]: http://www.sitemaps.org/
[3]: http://www.w3.org/TR/NOTE-datetime
[4]: http://www.sitemaps.org/protocol.html
