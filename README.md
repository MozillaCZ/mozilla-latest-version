# Mozilla Latest Version
Mozilla Latest Version WordPress plugin automatically checks the Mozilla application JSONs published from https://github.com/mozilla-releng/product-details, so you can always have the latest download link and version number on your website.

## Settings
The plugin settings you can find in _WordPress Admin -> Options -> MOZLV Settings_.
* __Cache type__: You can choose from two options. WordPress Transients API cache uses database to store the informations about the application version, or Files.
* __Cache expiration__: This option sets the cache expiration in seconds (default 3600 = 1 hour).
* __Link language code__: Here you can specify the language code for your download and other links. More information about the codes you can find in this [Mozilla Wiki page](https://wiki.mozilla.org/L10n:Locale_Codes).

## How to use it?
There are four shortcodes added by this plugin.

* `[mozilla-latest-version product=product]` - the latest version number of the specified _product_
* `[mozilla-latest-download-url product=product platform=platform]` - download URL of the latest version of the specified _product_ for _platform_
* `[mozilla-latest-langpack-url product=product platform=platform]` - download URL of the latest langpack (.xpi) for the specified _product_ and _platform_ (only available for desktop products)
* `[mozilla-latest-changelog-url product=product]` - changelog page URL for the latest version of the specified _product_
* `[mozilla-latest-requirements-url product=product]` - requirements page URL for the latest version of the specified _product_

### Attributes
* `product` possible values are `firefox` for desktop, `fenix`/`fennec`/`mobile` for Android, `ios` for iOS, `thunderbird` and `seamonkey`
* `platform` specifies the platform for download links. Possible values are `win`, `win64`, `linux`, `lin`, `linux64`, `lin64`, `osx` and `mac`
* `channel` specifies the channel of product are is product dependent (if no specified, `release` will be used)

#### Channel
* Firefox: `release`, `beta`, `devedition`, `nightly`, `esr`
* Mobile: `release`, `beta`, `nightly`
* iOS: `release`, `beta`
* Thundebird: `release`, `beta`
* SeaMonkey: `release`, `beta`
