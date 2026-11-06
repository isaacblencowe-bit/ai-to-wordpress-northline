# Validation and limitations

## Independent isolated validation — 6 November 2026

**Verdict: READY WITH DOCUMENTED LIMITATIONS.** The tested source was commit `81e35c2`, independently exported into a disposable WordPress environment. The subsequent documentation/setup-wording refinement does not change importer logic or frontend presentation; targeted checks for that refinement are reported separately in its review.

| Component | Tested version |
|---|---|
| WordPress | 7.1.4 |
| PHP | 8.2.35 |
| Elementor Free | 4.3.6 |
| WPForms Lite | 2.0.4 |
| WordPress Playground CLI | 3.1.62 |
| Node.js | 24.21.0 |

The environment used a fresh filesystem and SQLite database with PHP WebAssembly on macOS, bound only to loopback. No existing WordPress site, production database or credentials were shared. A test-only must-use plugin blocked WordPress outbound HTTP and email; indexing was discouraged. Generated geometric JPEGs and synthetic form details were used. No excluded photographs were downloaded or committed. The server was stopped after testing.

## Verified behaviour

- Theme ZIP integrity and single correct theme directory passed. WordPress's native Theme_Upgrader installed and activated the theme without photographs or reported PHP errors. All seven PHP files parsed on PHP 8.2.35.
- Elementor's native local-source importer imported Homepage, About and Contact. All 136, 63 and 33 native elements respectively were recognised, with no invalid instances or whole-page HTML widgets. Native documents saved and rendered on the frontend and in the editor.
- Direct Elementor UI tests changed the hero heading, supporting paragraph, service heading, CTA destination, project image, About heading, Contact heading and container spacing. Saves were verified on the frontend. Desktop container padding changed from 90px to 100px. The image was selected through the normal WordPress Media Library. Test values were restored; homepage restoration used the original imported template through Elementor's document API.
- The missing-image preflight returned `missing_release_images` without changing page count, media count or homepage assignment. Supplying four generated JPEGs enabled attachment import and homepage setup. A repeated setup returned the existing page rather than duplicating it. Standalone JSON imports with blank image IDs/URLs did not crash or use staging fallbacks.
- The seven-field demonstration form was reconstructed through WPForms' native API, connected to its native Elementor widget, inspected and saved in the WPForms builder. Empty required fields and invalid email were rejected. A valid dummy submission reached the explicit no-email demo confirmation. Notifications remained unchecked after saving and email was blocked. Live delivery was not tested.
- Homepage, About and Contact had no horizontal overflow at 1440×900, 1280×800, 820×1180, 768×1024, 390×844 and 360×800. Contact fields stayed within the viewport. Homepage/About heading overflow checks passed. The setup-generated homepage with six test-image placements also passed all six sizes.
- Mobile menu opening, aria-expanded, Escape closing and focus return passed. The demo panel opened, focused Close, closed with keyboard Enter and returned focus to its opener. Inspected frontend console logs had no warnings/errors.
- Reduced-motion JavaScript passed a mocked DOM/media-query test: no observer, instant scrolling and correct focus restoration. CSS reduced-motion rules were reviewed.
- Original concept HTML/CSS/JS and theme presentation CSS/JS/header/footer matched the tutorial source. Section order, editorial structure, Arial typography and colour foundations were preserved. Photographic fidelity was intentionally excluded.

Editor startup was slow and some navigation calls timed out while loading continued. All three editors eventually became usable. An optional promotion was dismissed without installing its advertised plugin. The initial loading state was not a confirmed theme defect. The paragraph test needed keyboard input to commit its editor change; this was a test interaction detail.

## Methods and unverified compatibility

The theme and templates were installed/imported using the installed native WordPress/Elementor APIs. The browser Appearance upload dialogue and complete interactive template-library insertion sequence were not independently exercised. The form was initially created through the native API, then inspected/saved through the builder; every click of creating it from a blank form was not replayed.

SQLite/PHP-WASM is not conventional PHP-FPM/MySQL hosting. The declared WordPress 6.9/PHP 8.0 minimums, other plugin versions, multisite and future upgrades remain untested. Browser editor assets include plugin-provided remote references; this was not a completely offline browser test. No universal compatibility claim is made.

An actual OS reduced-motion toggle, full screen-reader/WCAG audit, exhaustive clipping or pixel-diff review, physical devices and a cross-browser matrix were not tested. No Lighthouse/Core Web Vitals score or live email delivery is claimed. Blank image areas before replacement are expected. Replacement imagery and alt text require destination-specific review.

## Security, source integrity and historical evidence

The final read-only audit of the tested candidate covered 30 tracked files and 34 reachable file blobs across its two-commit history. Targeted scans identified no credentials, staging identifiers or private filesystem paths. No photographs, dependency bundles, database dumps or test artifacts were tracked. The GitHub repository remained private at `81e35c2`; the working tree was clean and no release/deployment occurred. Pattern scanning is not proof that every conceivable secret is absent.

Earlier tutorial-site QA is separate historical evidence, not the basis for these independent results. Raw development logs and screenshots containing environment context or excluded imagery are not distributed in this repository. The original development website and tutorial files were untouched.

The educational, unsupported and as-is disclaimer in README.md continues to apply. Always validate your own development/staging installation before production use. The owner subsequently approved public source sharing on 6 November 2026. This does not extend the tested compatibility or authorise a deployment.
