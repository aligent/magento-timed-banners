# Magento Timed Banners

Magento 1 module to add timed banners (similar to the demo notice) to your store
with customisable options within the admin interface.

## Install

Add this repository to your `composer.json`:

```json
{
  "type": "vcs",
  "url": "https://github.com/aligent/magento-timed-banners"
}
```

Then add the module to your dependencies:

```json
{
    "require": {
        "aligent/magento-timed-banners": "*"
    }
}
```

Finally tell Composer to install the module:

    $ composer update aligent/magento-timed-banners
    
## Usage

Navigate to `System -> Configuration` and look for `Timed Banners` under the `Aligent` tab. If you enable
the module you'll be able to setup a single banner to be shown between the two given dates (inclusive).

## Todo

- Multiple Banners
- Add ability to add times as well as dates