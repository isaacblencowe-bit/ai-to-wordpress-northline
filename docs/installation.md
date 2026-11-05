# Installation on a separate development site

## Preparation

Use an administrator account, writable uploads directory and backups. Theme declared minimums: WordPress 6.9, PHP 8.0. Historical tutorial runtime: WordPress 7.1.4 / PHP 8.2.35 / Elementor Free 4.3.5. Contact integration was tested with WPForms Lite 2.0.3.1. The sanitized release has not been installed on a second WordPress instance; verify compatibility locally before relying on it.

## Homepage setup

1. Supply `exterior.jpg`, `hero.jpg`, `interior.jpg`, `residence.jpg` under `theme/northline-projects/assets/images/`. Use images you may legally use. See assets-and-licensing.md for composition and dimensions. The importer refuses to proceed if any is missing. Do not publish replacement photos to Git without reviewing their redistribution rights.
2. From `theme/`, zip the single `northline-projects/` folder. Do not zip the repository root. Upload via Appearance → Themes → Add New → Upload Theme and activate.
3. Install and activate Elementor Free from WordPress.org. No Pro or third-party Elementor add-on is required for the homepage/About.
4. Set site title/tagline under Settings → General. Keep search indexing discouraged for this fictional demonstration.
5. Open Appearance → Northline Setup. This explicit action imports four Media Library attachments, creates/publishes the homepage, selects it as static front page, creates menus where locations are unassigned and changes Elementor's active global kit typography, colours and mobile/tablet breakpoints. Back up first. It does not run on activation.
6. Setup returns the existing imported homepage on repeated runs, preserving edits. It is not a reset/rollback tool. Restore your backup for rollback; the theme is not a full migration utility.
7. Check Settings → Reading and Appearance → Menus. Assigned menus are retained, so existing menus may need adjustment. Default destinations are homepage section anchors, not dedicated About/Contact pages.
8. Open the homepage with Elementor and replace the imported descriptive alt text to match your actual photographs. Default theme layout keeps the header/footer. Do not use Elementor Canvas.

## Standalone Elementor templates

`elementor/homepage.json`, `about.json`, `contact.json` are sanitized copies of the existing native exports. Import through Templates → Saved Templates → Import Templates (or the template library import control for your Elementor version). Create a draft page, Edit with Elementor and insert the saved template. Use Default page layout and hide the normal page title.

Select each Image widget's image in the local Media Library using media-map.md. Source IDs/URLs were cleared so no staging image download is required or attempted. Homepage setup is the preferred path because it remaps local media automatically. Do not import `theme/northline-projects/inc/homepage.json` directly: that internal starter contains relative filenames for the setup importer.

About CTA destinations use `/#contact` and `/#services`. If WordPress is installed in a subdirectory, change these to your actual homepage and anchors. Contact's native WPForms widget retains its styling but has no selected form; install WPForms Lite, build the form using wpforms.md, then select it in the widget. An Elementor page export is not a WPForms form export.

Keep About and Contact as drafts until reviewed. Publish and add menu links only when intended. No SEO metadata, Yoast settings, server noindex header or tutorial-site database state is included. Configure these on the destination deliberately.

## Review

Match Elementor breakpoints to mobile 760px/tablet 1100px; a CSS refinement applies below 380px. Use Arial/Helvetica/sans-serif. Check desktop 1440×900 and 1280×800, tablet 820×1180 and 768×1024, phones 390×844 and 360×800. Check all images, heading wrapping, overflow, menu keyboard behaviour, demo panel focus and WPForms validation. Save one harmless test edit and verify the frontend, then restore it. Do not claim successful installation based on JSON parsing alone.
