=== wp_head() cleaner ===
Contributors: jwilsson
Tags: wp_head, header, meta, clean, remove, generator
Requires at least: 3.1
Tested up to: 4.3
Stable tag: 1.0.0
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
**1.0.0**
Initial release.