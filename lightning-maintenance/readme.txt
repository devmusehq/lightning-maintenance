=== Lightning Maintenance ===
Contributors:      devmuse
Donate link:       https://devmuse.co
Tags:              maintenance, maintenance-mode, coming-soon, under-construction, 503
Requires at least: 6.0
Tested up to:      7.0
Requires PHP:      7.4
Stable tag:        1.0.1
License:           GPL-2.0-or-later
License URI:       https://www.gnu.org/licenses/gpl-2.0.html

Blazing-fast, lightweight maintenance mode for WordPress. Proper 503 status, safe test mode, and zero bloat.

== Description ==

Lightning Maintenance is a minimalist, performance-first maintenance mode plugin.

Most maintenance plugins are either too minimal or bloated with unnecessary features. Lightning Maintenance does one thing exceptionally well: lets you take your site offline cleanly, safely, and with almost zero impact on performance.

**Features**

* Extremely lightweight (< 40 KB zipped)
* Proper 503 Service Unavailable status with Retry-After header
* Safe Test Mode – preview the maintenance page without affecting visitors
* Simple customization: logo, headline, message, background & text colour
* Clean admin bar status indicator
* Emergency exit URL (`?exit-maintenance=1`)
* Zero ads, zero upsells, zero bloat

== Installation ==

1. Upload the `lightning-maintenance` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to **Lightning Maintenance** in the admin menu to configure

== Frequently Asked Questions ==

= Is this plugin really free forever? =
Yes. Completely free with no premium version or upsells.

= Will it slow down my site? =
No. It is deliberately built to have minimal performance impact and works great with major caching plugins.

= How do I safely preview the maintenance page? =
Enable **Test Mode**. Only logged-in administrators will see the maintenance page.

= What if I'm locked out? =
Visit `yoursite.com/?exit-maintenance=1` to instantly disable maintenance mode.

== Screenshots ==

1. Settings page with clean controls and colour pickers
2. Admin bar status indicator
3. Maintenance page (with logo and custom colours)

== Changelog ==

= 1.0.1 =
* Improved colour picker reliability using WP's native picker
* Added text domain loading for future translations
* Updated Tested up to 7.0
* Minor admin bar and code polish
* Better documentation comments

= 1.0.0 =
* Initial release

Made with ❤️ by DevMuse — https://devmuse.co