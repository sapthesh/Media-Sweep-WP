=== Media Sweep ===
Contributors: sapthesh
Tags: media, cleanup, database, orphan, images, sweep, scan
Requires at least: 5.0
Tested up to: 6.4
Stable tag: 1.1.0
Requires PHP: 7.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A powerful scanning utility to find and remove orphaned media files. Scans posts, post meta, and options tables.

== Description ==

Media Sweep provides a high-level server maintenance tool that prioritizes strict database safety. Instead of just checking if an image is attached to a post, it runs a deep search across the post content, post meta, and options tables.

It generates a detailed report of every media file, categorizing them as "Used in Post Content," "Used in Custom Meta," "Used in Options," or "Potential Orphan."

This initial version focuses on scanning and reporting. Future versions will include the dry-run and deletion functionality.

== Installation ==

1. Upload the `media-sweep` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Go to Media > Media Sweep to start a scan.

== Frequently Asked Questions ==

= Does this plugin delete files automatically? =

No, not in this version. The current version only scans and reports on media file usage. Deletion functionality will be added in a future release.

== Changelog ==

= 1.1.0 =
* Security Update: Prefixed all functions, classes, and IDs with 'media-sweep-' to prevent conflicts with other plugins, following WordPress coding standards.

= 1.0.0 =
* Initial release.
* Renamed plugin to "Media Sweep".
* Implemented scanning of posts, post meta, and options.
* Added an admin page with a detailed report table.

