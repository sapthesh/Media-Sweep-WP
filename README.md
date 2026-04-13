# Media Sweep for WordPress

[![WordPress Plugin Version](https://img.shields.io/badge/Version-1.1.0-blue)](https://wordpress.org/plugins/media-sweep/)
[![Tested up to](https://img.shields.io/badge/Tested%20up%20to-6.4-brightgreen)](https://wordpress.org/)
[![Requires PHP](https://img.shields.io/badge/Requires%20PHP-7.4+-red)](https://www.php.net/)
[![License](https://img.shields.io/badge/License-GPLv2%20or%20later-blue.svg)](https://www.gnu.org/licenses/gpl-2.0.html)

A powerful and safe WordPress scanning utility to find media files that are no longer in use. Media Sweep performs a deep scan of your database to help you identify potentially orphaned images and other media uploads.

## What is Media Sweep?

Many media cleaner plugins simply check if a media file is attached to a post or page. This is a dangerous approach. Images are often used in ways that "simple" cleaners can't detect, such as:

*   Referenced in page builder widgets (Elementor, Divi, etc.).
*   Used in custom fields (Advanced Custom Fields, etc.).
*   Set as a logo or other element in theme options.
*   Hard-coded into theme CSS files.

Deleting an image that is "in use" but not "attached" can break your website's appearance.

**Media Sweep is different.** It is a high-level server maintenance tool that prioritizes safety by performing a deep scan across your entire database, not just post attachments. It checks post content, the `wp_postmeta` table, and the `wp_options` table to build a much more accurate picture of where your media is actually being used.

## Features

*   **Deep Database Scan:** Scans posts, pages, custom post types, post meta, and the options table.
*   **Clear Usage Categorization:** Identifies and categorizes files as:
    *   `Used in Post Content`
    *   `Used in Custom Meta`
    *   `Used in Options`
    *   `Potential Orphan`
*   **Detailed Reporting:** Presents results in a clean, easy-to-read table within your WordPress admin area.
*   **Safe & Non-Destructive:** This version **does not delete any files**. It is a read-only reporting tool, allowing you to safely assess the situation before taking any manual action.
*   **Clean & Lightweight:** Built with performance and WordPress coding standards in mind.

## Installation

1.  Download the latest release as a `.zip` file from the [GitHub repository](https://github.com/your-username/media-sweep).
2.  Log in to your WordPress admin dashboard.
3.  Navigate to **Plugins > Add New**.
4.  Click the **Upload Plugin** button at the top of the page.
5.  Select the `media-sweep.zip` file you downloaded.
6.  Click **Install Now**.
7.  Once installed, click **Activate Plugin**.

## How to Use

1.  After activating the plugin, navigate to **Media > Media Sweep** in your WordPress admin menu.
2.  Click the **Start Scan** button.
3.  The plugin will scan your database. This may take a few moments, depending on the size of your media library and database.
4.  Once complete, a report will be displayed, showing each media file and its detected usage category. You can review this list to identify files that are likely "Potential Orphans."

## Roadmap (Future Development)

This is the first stable version of Media Sweep, focusing on safe and accurate scanning. Future development will focus on adding powerful cleanup tools:

*   **Dry Run Feature:** Move potential orphans to a temporary server folder (`.trashed` or similar) so you can verify your site is not broken before final deletion.
*   **One-Click Deletion:** A button to safely and permanently delete the files identified as orphans *after* a dry run.
*   **Theme & CSS Scanning:** An advanced (and optional) scan that searches active theme and CSS files for file references.
*   **Integration with `WP_Filesystem`:** To ensure all file operations are handled securely and according to WordPress best practices.

## Changelog

### Version 1.1.0 (Current)

*   **Security Update:** Prefixed all functions, classes, and IDs with `media-sweep-` to prevent conflicts with other plugins, following official WordPress coding standards.

### Version 1.0.0

*   Initial release.
*   Plugin name changed to "Media Sweep".
*   Implemented deep scanning of `posts`, `postmeta`, and `options` tables.
*   Added an admin page with a detailed report table to display results.

---

## Contributing

Contributions are welcome! If you have a suggestion or a bug fix, please open an issue or submit a pull request on the [GitHub repository](https://github.com/your-username/media-sweep).

## License

This plugin is licensed under the GPLv2 or later.
[https://www.gnu.org/licenses/gpl-2.0.html](https://www.gnu.org/licenses/gpl-2.0.html)
