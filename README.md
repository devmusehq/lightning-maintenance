# Lightning Maintenance

[![WordPress Plugin Version](https://img.shields.io/wordpress/plugin/v/lightning-maintenance.svg)](https://wordpress.org/plugins/lightning-maintenance/)
[![License](https://img.shields.io/badge/license-GPL--2.0%2B-blue.svg)](https://www.gnu.org/licenses/gpl-2.0.html)

**Blazing-fast, lightweight maintenance mode for WordPress.**  
Proper 503 status, safe test mode, zero bloat, and under 40 KB zipped.

Made with ❤️ by [DevMuseHQ](https://github.com/devmusehq)

## Features

- Extremely lightweight (< 40 KB)
- Proper `503 Service Unavailable` status with `Retry-After` header
- Safe **Test Mode** – only logged-in admins see the maintenance page
- Simple customization: logo, headline, message, background & text colour
- Clean admin bar status indicator
- Emergency exit URL: `?exit-maintenance=1`
- No ads, no upsells, no bloat
- Fully compatible with major caching plugins

## Installation

### From WordPress.org (Recommended)
1. Search for **"Lightning Maintenance"** in your WordPress dashboard → Plugins → Add New
2. Install and activate

### Manual / Development Version
1. Download the latest release from this repository
2. Upload the `lightning-maintenance` folder to `/wp-content/plugins/`
3. Activate the plugin through the Plugins menu

## Usage

1. Go to **Maintenance** in the WordPress admin menu
2. Toggle **Maintenance Mode** on
3. Use **Test Mode** to safely preview the page
4. Customize logo, colours, headline and message
5. Save — done!

**Locked out?** Visit `yoursite.com/?exit-maintenance=1` to instantly disable maintenance mode.

## Screenshots

(Will be added once the plugin is live on WordPress.org)

## Development

This repository is the development home for Lightning Maintenance.

- Main development happens here on GitHub
- Stable releases are synced to the [WordPress.org Plugin Directory](https://wordpress.org/plugins/lightning-maintenance/) (once approved)

### Contributing

Contributions are welcome! See [CONTRIBUTING.md](CONTRIBUTING.md) for details.

### Support

- For plugin support → Use the [WordPress.org support forum](https://wordpress.org/support/plugin/lightning-maintenance/) (once live)
- Bug reports & feature requests → Open an [Issue](https://github.com/devmusehq/lightning-maintenance/issues)

## License

This plugin is licensed under the [GNU General Public License v2.0 or later](https://www.gnu.org/licenses/gpl-2.0.html).

---

**DevMuseHQ** — Lightweight, zero-bloat WordPress plugins.
