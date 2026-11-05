# Architecture and release changes

The theme is a classic lightweight WordPress theme. `functions.php` registers supports, menus, Customizer fields and assets. `header.php`/`footer.php` own shared navigation and document structure. `front-page.php` renders `the_content()`; the homepage is not embedded in PHP. `page.php` supports Elementor and ordinary WordPress content. `index.php` is the fallback.

`inc/setup.php` uses native WordPress media/menu APIs and Elementor documents/kit APIs. An administrator-triggered, nonce-protected import maps the internal starter JSON to real attachments. It changes global kit settings; avoid running it on a populated site without backups. No custom database queries, remote execution endpoints or credentials are required.

Native containers, headings, text editors, images and buttons form the homepage/About. Contact additionally uses WPForms' native widget. No whole-page HTML widgets are used. CSS in `assets/theme.css` provides foundations, header/footer, gradients, cropping and responsive refinements. `assets/theme.js` handles menu, demo panel focus and reduced-motion-aware reveals without external libraries.

## Release-only differences from the tutorial sources

- Third-party JPEGs excluded; original HTML/CSS/JS retained unchanged. Concept needs replacement images before visual use.
- Standalone exports retain their element IDs, hierarchy, content and styles; media IDs/URLs are blank, Contact form ID is blank, and two About links use root-relative home anchors. See media-map.md for images.
- Theme setup gains a local readability preflight for all four excluded JPEGs before media/settings mutations. Existing imported-page fast return remains intact. This addition has been inspected statically, not runtime tested.
- Following explicit owner approval on 6 November 2026, the release uses GPL-2.0-or-later, with the official GPLv2 text in LICENSE and matching theme/README notices. External dependencies and excluded photographs retain their separate rights.
- Documentation is rewritten for a new installation, excluding tutorial installation IDs, staging hosts, local paths and diagnostic artifacts.

Theme PHP/CSS/JS otherwise remain the tutorial source. Original concept and live WordPress website have not been changed by release preparation. No database configuration or plugin code is bundled.
