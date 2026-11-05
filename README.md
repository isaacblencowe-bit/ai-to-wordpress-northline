# AI to WordPress: Northline Projects

Northline Projects is a fictional Melbourne construction website created for an Isaac Design YouTube tutorial. This educational source demonstrates how ChatGPT and Codex can transform a custom HTML concept into a lightweight WordPress theme with native Elementor-editable content.

**Private review candidate. Licence approval is pending. Do not publish yet.** Photography is intentionally excluded. This is source for assembling the demonstration, not a ready-to-import complete website backup.

Tutorial: **[YouTube tutorial URL to be added once published]**

## Included

- `concept/`: original standalone HTML/CSS/JavaScript for comparison, without photographs.
- `theme/northline-projects/`: actual custom theme source, with documented release-only changes.
- `elementor/`: existing Homepage, About and Contact native page exports, stripped of destination-specific media/form IDs and staging URLs.
- `docs/`: installation, editing, architecture, media mapping, form reconstruction, licensing and verification notes.

No WordPress core, plugin source, credentials, database, form entries, development logs or original Git history are included. There is no generated theme ZIP: create one locally after supplying rights-cleared photographs.

## Requirements and installation

Theme headers declare WordPress 6.9+ and PHP 8.0+. Prior tutorial testing recorded WordPress 7.1.4, PHP 8.2.35 and Elementor Free 4.3.5; this is historical evidence, not certification of other versions. Contact requires WPForms Lite (tutorial: 2.0.3.1). Elementor Pro is not required. Yoast is optional and its database configuration is not exported.

1. Use a separate staging installation, with backups and indexing disabled.
2. Supply four licensed JPEGs as described in [asset notes](docs/assets-and-licensing.md).
3. Zip the `northline-projects` directory inside `theme/`; upload and activate it through Appearance → Themes.
4. Install Elementor Free. Run Appearance → Northline Setup to create the native homepage, media, menus and matching global kit settings.
5. For additional pages, import the corresponding JSON via Elementor's template library, insert into a draft page, select local images and configure the Contact form.

Read [full installation instructions](docs/installation.md) first: setup publishes a homepage and changes Reading, menu assignments and Elementor global settings. Theme activation alone does not import content.

## Editing and architecture

The theme supplies WordPress integration, global header/footer, typography foundations and lightweight interactions. Elementor containers and standard widgets hold the page content and most layout settings. Stable CSS classes handle precise crops, overlays and responsive refinements. Contact uses the native WPForms Elementor widget; recreate the form and select its new ID.

Text, imagery, normal links and spacing are edited visually in Elementor. Menus and identity use WordPress controls. Advanced design refinements remain in theme CSS/JavaScript. See [editing](docs/editing-guide.md) and [architecture](docs/architecture.md).

Importing these JSON files into an unrelated theme will not reproduce the complete website. Media selections and the form are intentionally unresolved until configured on your installation.

## Educational disclaimer

This repository is provided as an educational reference accompanying the Isaac Design YouTube tutorial. It is not a maintained commercial WordPress theme or a supported website template.

The source is provided as-is, without guaranteed compatibility, ongoing updates or individual technical support.

Always test in a development or staging environment before using any code on a production website.

## Fictional content and licence

Northline Projects, its projects, testimonials and contact details are fictional demonstration content. Illustrative architecture does not establish completed work or a Melbourne location. The homepage enquiry panel sends nothing. The Contact form must keep notifications off during demonstration testing.

No licence has been applied to this release pending owner approval. GPL-2.0-or-later is recommended; see [licensing assessment](docs/assets-and-licensing.md). No permission to redistribute third-party photographs is implied. See [validation](docs/validation.md) and [release review](docs/release-review.md) before publication.
