# MindBlank HTML WordPress Theme

MindBlank is a custom starter theme developed by **Mindshare Labs** to serve as the foundation for our WordPress projects. It is intentionally minimal, but modern — designed to integrate seamlessly with WordPress’s block editor while bringing in Bootstrap 5 for layout consistency.

---

## Why We Developed Our Own Theme Template

We found that most existing starter themes or frameworks were either too opinionated or lacked full support for Gutenberg blocks. By developing our own theme:

- We ensure a **clean baseline** without unnecessary bloat.
- We can tightly control **Bootstrap integration** so WordPress blocks behave like their Bootstrap counterparts.
- We support **theme.json configuration** as the single source of truth for colors, spacing, and typography.
- We maintain a **modern build process** (npm + gulp) tailored to our workflow.

---

## How the Theme Template Works

- **theme.json**: Defines the WordPress design tokens (colors, fonts, spacing, layout sizes). These are bridged into Bootstrap variables via SCSS so both systems stay in sync.
- **SCSS + Gulp build**: SCSS files (in `/sass`) compile into front-end and editor stylesheets. These handle both Bootstrap imports and theme overrides.
- **Bootstrap connector**: Custom PHP logic maps core Gutenberg block output into Bootstrap 5 equivalents (e.g., `wp-block-columns` → `.row .col`).
- **WP_HTML_Tag_Processor**: Used in our render filters to reliably inject Bootstrap classes into block HTML, ensuring consistent markup without fragile regex.
- **Templates**: Minimal PHP templates lean on Gutenberg blocks for structure. We keep markup simple and semantic.

---

## The Basics of How It’s Built

1. **Base SCSS files**  
   - `styles.scss`: Imports the collection of styles for our theme. This includes bootstrap and bootstrap's optional components.   
   - `editor-styles.scss`: Lean version for the block editor canvas, only enqueued in the Gutenberg editor..  
   - `custom-variables.scss`: Bridges WordPress theme.json tokens into CSS variables and Bootstrap.
   - `wordpress-bootstrap-connector.scss`: Specific SCSS to bridge wordpress styles with bootstrap styles
   - `custom-styles.scss`: All Styles associated with the theme, enqueued only on the front end and contains all brand-specific styling. **This is where development happens**
   - `block-styles.scss`:  All styles associated with custom gutenburg blocks. Enqueued only when one of those blocks is present. **This is where development happens**

---

## Theme Structure & Conventions

- **Custom Gutenberg blocks**  
  - All new custom blocks must be placed in the `/blocks` folder.  
  - Block-specific styles must be included in `block-styles.scss`. This stylesheet is only enqueued when that block is present, keeping front‑end CSS lean.

- **Advanced Custom Fields (ACF)**  
  - This theme assumes ACF is present.  
  - Custom block settings and content can leverage ACF functions and field groups as needed.

- **Templates**  
  - All theme templates should consistently use Bootstrap‑based classes for structure and layout.  
  - Refrain from injecting custom styles when a Bootstrap utility class or component class will suffice.  
  - Custom styling should only be added when Bootstrap does not provide an equivalent.

---

## Installing & Using the Build System

The theme includes a Gulp-based build system for compiling SCSS → CSS.

1. **Install dependencies**  
   ```bash
   npm install
   ```

2. **Run the build**  
   - Compile once:
     ```bash
     gulp
     ```
   - Or watch for changes:
     ```bash
     gulp watch
     ```

3. **Outputs**  
   - Compiled CSS goes to `/css/`  
   - Separate builds for front-end and editor styles.

---

## Additional Information

- **Extendable**: You can easily add new block mappings (tables, buttons, galleries, etc.) to the connector as project needs evolve.
- **Custom patterns**: We recommend building block patterns (`patterns/`) for common Bootstrap-based layouts (grid, hero, call-to-action).
- **Editor styles**: Always scoped to `.editor-styles-wrapper` to avoid leaking into the Gutenberg UI.
- **Best practice**: Keep `theme.json` as the canonical design source. Colors, spacing, and typography cascade everywhere via CSS variables.

---

## Contributing / Notes

This theme is an internal Mindshare Labs foundation. If you extend or modify it for client work:
- Keep changes modular where possible (new SCSS partials, new block mappings).
- Avoid hardcoding values; prefer CSS vars bridged from theme.json.
- Document any client-specific overrides in the project repo.

---

© Mindshare Labs, Inc.