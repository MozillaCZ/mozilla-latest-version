# Mozilla Latest Version
Mozilla Latest Version WordPress plugin automatically checks the Mozilla application JSONs so you can always have the latest download link and version number on your website.

## Settings
The plugin settings you can find in _WordPress Admin -> Options -> MOZLV Settings_.
* __Cache type__: You can choose from two options. WordPress Transients API cache uses database to store the informations about the application version, or Files.
* __Cache expiration__: This option sets the cache expiration in seconds (default 3600 = 1 hour).
* __Link language code__: Here you can specify the language code for your download and other links. More information about the codes you can find in this [Mozilla Wiki page](https://wiki.mozilla.org/L10n:Locale_Codes).

## How to use it?
There are currently four shortcodes added by this plugin. And three more additional for easier migration from the Mozilla.sk CMS Plugin without need of any content change. Here are explained all of them with their attributes.

### Shortcodes
* `[mozilla-latest-version product=product]` - the latest version number of the specified _product_
These URL shortcodes below work also as [enclosing](https://codex.wordpress.org/Shortcode_API#Enclosing_vs_self-closing_shortcodes). Using `[shortcode]...[/shortcode]` will produce HTML link `<a href="URL">...</a>` instead of an URL string.
* `[mozilla-latest-download-url product=product platform=platform]` - download URL of the latest version of the specified _product_ for _platform_
* `[mozilla-latest-langpack-url product=product platform=platform]` - download URL of the latest langpack (.xpi) for the specified _product_ and _platform_ (not available for `fennec`)
* `[mozilla-latest-changelog-url product=product]` - changelog page URL for the latest version of the specified _product_
* `[mozilla-latest-requirements-url product=product]` - requirements page URL for the latest version of the specified _product_

#### Shortcodes for easier migration from the [Mozilla.sk CMS Plugin](https://github.com/MozillaCZ/mozsk-cms).
The Mozilla.sk CMS plugin shortcodes work as [self-closing](https://codex.wordpress.org/Shortcode_API#Enclosing_vs_self-closing_shortcodes) only.
* `[moz-download-version app=product]` = `[mozilla-latest-version product=product]`
* `[moz-download-url app=product platform=platform]` = `[mozilla-latest-download-url product=product platform=platform]`
* `[moz-download-rn app=product]` = `[mozilla-latest-changelog-url product=product]`

#### Including directly into the WordPress template
Simply use [do_shortcode()](https://codex.wordpress.org/Function_Reference/do_shortcode) function.

### Attributes
* `product` possible values are `firefox` for desktop, `fennec` or `mobile` for Android, `thunderbird` and `seamonkey`
* `platform` specifies the platform for download links. Possible values are `win`, `win64`, `linux`, `lin`, `linux64`, `lin64`, `osx` and `mac`
* `channel` specifies the channel of product are is product dependent (if no specified, `release` will be used)

### Channel
* Firefox: `release`, `beta`, `aurora`, `esr`
* Mobile: `release`
* Thundebird: `release`
* SeaMonkey: `release`, `beta`, `aurora`
