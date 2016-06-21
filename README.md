# Cache Version

Contributors: kasparsd   
Tags: cache, caching, performance, expiry, headers
Requires at least: 3.0.1   
Tested up to: 3.9   
Stable tag: trunk   
License: GPLv2 or later   

Adds a version number (a timestamp) of all content that can be used in cache keys.


## Description

Stores a timestamp as `cache-version` in object cache and updates its value every time a post,
comment, term or menu is created or updated. Also adds a `Last-Modified` header to all HTTP responses.


## Installation

Install it from the official WordPress repository or use the plugin search in your WordPress dashboard.


## Frequently Asked Questions

None.


## Screenshots

None.


## Changelog

### 0.3 (June 21, 2016)
* Use a transient to ensure it works on sites with no object caching enabled.

### 0.1
* Initial release.


### Upgrade Notice
