# Lightning Maintenance

A focused, free maintenance-mode plugin by [DevMuse](https://devmuse.co/plugins/lightning-maintenance/).

## Requirements

WordPress 6.0 or later, PHP 7.4 or later. Version 1.0.2 is tested with WordPress 7.1.4.

## Features

- Public maintenance screen with HTTP 503 and a Retry-After header.
- Test Mode shows the maintenance screen to administrators while visitors see the live site.
- Administrators can use the live site during normal maintenance mode.
- Custom logo, headline, message and colours.
- Admin bar status and a signed administrator-only emergency exit link.

## Install and use

Download the installable ZIP from DevMuse or this repository's release assets. Upload it through Plugins → Add New → Upload Plugin, activate it, then open **Maintenance** in the admin sidebar.

Lightning Maintenance is distributed directly. It is not available in the WordPress.org Plugin Directory.

## Turn maintenance off

Sign in as an administrator, open **Maintenance** and switch maintenance mode off. Quick Help also shows a signed Emergency Exit link. The link requires a logged-in administrator and a valid security nonce; the plain `?exit-maintenance=1` parameter cannot sign you in or bypass those checks.

## Caching and data

Clear or bypass full-page caches and CDNs when switching modes, then check an anonymous visit. Cached pages may be served before WordPress or this plugin runs.

The plugin stores settings locally and has no external API. An update retains settings. Deactivation and uninstall remove them. The site's theme or other plugins can still load their own assets on the maintenance screen.

## Release 1.0.2

WordPress 7.1.4 compatibility check, readme-only Tested up to metadata, corrected emergency exit and cache guidance. Full release history is in [readme.txt](readme.txt).

## Support and licence

Use [GitHub issues](https://github.com/devmusehq/lightning-maintenance/issues) for bugs. Licensed under GPL-2.0-or-later; see [LICENSE](LICENSE).

## Compatibility checks

Checked on 16 November 2026 with WordPress 7.1.4 and 6.6, PHP 8.5.5 and the official SQLite drop-in. HTTP checks cover 503 and Retry-After responses, no-cache headers, administrator bypass, Test Mode and signed/unsigned emergency exit handling. PHP 7.4 compatibility passed static checks. The current SQLite drop-in cannot run WordPress 6.0, so these checks do not establish a 6.0 runtime result.
