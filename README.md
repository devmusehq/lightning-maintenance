# Lightning Maintenance

**Blazing-fast, lightweight maintenance mode for WordPress.**  
Proper 503 status, safe test mode, zero bloat, and under 40 KB zipped.

Made with ❤️ by [DevMuseHQ](https://github.com/devmusehq)

[![License](https://img.shields.io/badge/license-GPL--2.0%2B-blue.svg)](https://www.gnu.org/licenses/gpl-2.0.html)

## Features

- Extremely lightweight (< 40 KB zipped)
- Proper `503 Service Unavailable` status with `Retry-After` header
- Safe **Test Mode** – only logged-in admins see the maintenance page
- Custom logo, headline, message, background & text colour
- Clean admin bar status indicator
- Emergency exit URL (`?exit-maintenance=1`)
- Zero ads, zero upsells, zero bloat
- Works great with major caching plugins

## Installation

### From WordPress.org (Recommended)
Search for **Lightning Maintenance** in your WordPress dashboard under Plugins → Add New.

### From GitHub (Development Version)
1. Download the latest release or clone this repository
2. Upload the `lightning-maintenance` folder to `/wp-content/plugins/`
3. Activate the plugin

## Usage

1. Go to **Maintenance** in the WordPress admin sidebar
2. Toggle **Maintenance Mode** on
3. Use **Test Mode** to safely preview before going live
4. Customise the logo, colours, headline and message
5. Save settings

**Locked out?** Simply visit `yoursite.com/?exit-maintenance=1` to disable maintenance mode instantly.

## Screenshots

(Will be added once the plugin is approved on WordPress.org)

## Development & Contributing

This is the official development repository for Lightning Maintenance.

- Main development happens here on GitHub
- Stable releases are pushed to the [WordPress.org Plugin Directory](https://wordpress.org/plugins/lightning-maintenance/) (once approved)

Contributions, bug reports, and feature requests are welcome!  
See [CONTRIBUTING.md](CONTRIBUTING.md) for details.

## Support

- Plugin support → [WordPress.org support forum](https://wordpress.org/support/plugin/lightning-maintenance/) (once live)
- Bugs & ideas → Open an [Issue](https://github.com/devmusehq/lightning-maintenance/issues)

## License

Licensed under the [GNU General Public License v2.0 or later](https://www.gnu.org/licenses/gpl-2.0.html).

---

**DevMuseHQ** — Lightweight, zero-bloat WordPress plugins.
