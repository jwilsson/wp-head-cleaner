=== wp_head() cleaner ===
Contributors: jwilsson
Tags: wp_head, header, meta, clean, remove, generator
Requires at least: 3.1
Tested up to: 5.5
Stable tag: 1.5.8
License: GPL2

Remove unused tags from wp_head() output.

== Description ==
WordPress adds all kinds of `<meta>`-tags to the `<head>` section of your site.
Some of these tags are quite good and have real uses, others make sense for some sites and others doesn't.
Some tags are even considered a security risk, since they tell the world which version of WordPress you're currently running.

This plugin allows you to remove all of the `<meta>`-tags that WordPress outputs by default.
You decide on a tag-by-tag basis which tags to remove and which to keep. Nothing's enforced, you're 100% in charge.

== Installation ==
= Install =
1. Upload the plugin's folder to your WordPress plugin folder (manually or through `Plugins` / `Add new` menu in WordPress).
2. Activate the plugin through the `Plugins` menu in WordPress.
3. Decide on which tags to remove via the `Settings` / `wp_head() cleaner` menu in WordPress.

= Uninstall =
1. Deactivate the plugin through the `Plugins` menu in WordPress.
2. Click on `Delete` which will delete both the plugin files and the settings stored in the database.

== Screenshots ==
1. Admin interface

== Changelog ==
= 1.5.8 =
* Tested with WordPress 5.5.
* Updated Swedish translations.

= 1.5.7 =
* Tested with WordPress 5.4.

= 1.5.6 =
* Tested with WordPress 5.3.

= 1.5.5 =
* Tested with WordPress 5.2.

= 1.5.4 =
* Tested with WordPress 5.1.

= 1.5.3 =
* Tested with WordPress 5.0.

= 1.5.2 =
* Tested with WordPress 4.9.

= 1.5.1 =
* Tested with WordPress 4.8.

= 1.5.0 =
* Added Composer support.
* Moved localization loading to `init` hook.
* Minor code style fixes.
* Tested with WordPress 4.7.

= 1.4.0 =
* Added option for oEmbed scripts.

= 1.3.0 =
* Added option for resource hints.
* Tested with WordPress 4.6.

= 1.2.0 =
* Added action links to plugin screen.
* Added labels to option descriptions.
* Tested with WordPress 4.5.

= 1.1.0 =
* Added option for REST API.
* Added option for oEmbed.
* Tested with WordPress 4.4.

= 1.0.0 =
* Initial release.
