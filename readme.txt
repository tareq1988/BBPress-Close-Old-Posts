=== bbPress Close Old Posts ===
Contributors: tareq1988
Tags: bbpress, cron, close, topics
Donate link: http://tareq.wedevs.com/donate/
Requires at least: 3.6
Tested up to: 4.4.2
Stable tag: trunk
License: GPL2

Close bbPress topics with no activity for X days

== Description ==
Close bbPress topics with no activity for `X` days.

Move file to plugins directory and activate. There are no settings.

By default, it is **15** days. if you need to change the duration, define it from your `wp-config.php` file:
`define( \'BBP_CLOSE_TOPIC_DURATION\', 30 ); // for 30 days`

= Contribute =
[Github](https://github.com/tareq1988/BBPress-Close-Old-Posts)

= Author =
Brought to you by [Tareq Hasan](http://tareq.wedevs.com) from [weDevs](http://wedevs.com)

== Installation ==
Download and install.

== Frequently Asked Questions ==
**Q: Can I change the duration**
A: By default, it is **15** days. if you need to change the duration, define it from your `wp-config.php` file:
`define( \'BBP_CLOSE_TOPIC_DURATION\', 30 ); // for 30 days`

== Changelog ==
= 1.0=
* Refactored and configurable via `wp-config.php`

= 0.1 =
* First release.

== Upgrade Notice ==
Nothing here yet