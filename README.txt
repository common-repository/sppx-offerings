=== SPPX Offerings ===
Contributors: Bit Source
Tags: custom post type, API, content creation
Requires at least: 3.0.1
Tested up to: 5.9
Stable tag: 1.0
Requires PHP: 7.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Accesses the Silicon Prairie API to all user to create posts that display information from Issues from their dashboard.

== Description ==

This plugin creates a new post type called Issue. Users with a URI from Silicon Prairie can create these posts and
insert the URI into the custom form. The post will then be populated with up-to-date information about the Issue from
Silicon Prairie's API. The plugin allows any user to host multiple Issues on their site without the need to recreate them. 
Issues are created from the New menu and the dashboard. There is also a form to enter a Google Maps API key to generate maps
Issues accessible in the dashboard from Settings/Issue Plugin Menu.

== Frequently Asked Questions ==
No FAQ yet. Any questions please ask.

== Screenshots ==

1. Issue creation form.
2. Plugin settings page.

== Changelog ==

= 1.0.0 =
First release

= 1.0.1 =
Fixes bug with update functionality.

Fixes an issue where the updater in update-if-needed.php was calling the wrong function, causing the updates to fail.