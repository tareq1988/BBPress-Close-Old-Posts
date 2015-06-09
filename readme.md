# BBPress Close Old Posts

Close bbPress topics with no activity for `X` days.

By default, it is **15** days. if you need to change the duration, define it from your `wp-config.php` file:
```php
define( 'BBP_CLOSE_TOPIC_DURATION', 30 ); // for 30 days
```

### Changelog
------------
**1.0**

* Refactored and configurable via `wp-config.php`

**0.1**

* First release.

### Credit
Forked from [thethemefoundry/BBPress-Close-Old-Posts](https://github.com/thethemefoundry/BBPress-Close-Old-Posts)