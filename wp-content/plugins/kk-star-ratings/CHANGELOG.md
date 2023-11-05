# Change Log

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).

## [5.4.6] - 2023-10-21

### Fixed
- Race condition during votes has been fixed.
- Only published posts can be rated.

### Updated
- Bump Freemius SDK.

## [5.4.5] - 2023-07-05

### Updated
- Bump Freemius SDK.

## [5.4.4] - 2023-06-29

### Fixed
-   Lookup IP addresses in alternative headers only when admin/user explicitly allows this as a strategy. Previously this was implicity done without the consent of the admin/user.

## [5.4.3] - 2023-03-30

### Updated
-   Bumped WordPress to v6.2.
-   Bumped freemius to v2.5.6.
### Fixed
-   `kk_star_ratings()` helper function has been fixed.

## [5.4.2] - 2022-12-18

### Added
-   Allow for `starsonly` parameter in shortcode.

## [5.4.1] - 2022-11-19

### Added
-   Allow for `legendonly` parameter in shortcode.
### Updated
-   Bumped freemius to v2.5.1.
### Fixed
-   Log IP (fingerprint) only when unique votes is enabled.
-   Get the correct post title when a custom post ID is being used.

## [5.4.0] - 2022-11-06

### Added
-   Custom blocks support.

### Fixed
-   Text domain path was incorrect in `load_plugin_textdomain`.
-   Use single quotes in payload html attribute (#124).

## [5.3.4] - 2022-09-06

### Fixed

-   Unnecessary duplicate queries during post hydration has been fixed.

## [5.3.3] - 2022-09-03

### Fixed

-   Shortcode was being auto-embedded in excerpts. Not the case anymore.

## [5.3.2] - 2022-08-10

### Added

-   Added ability to ignore shortcode using the `ignore` property.

### Updated

-   Bumped WordPress version (6.0.1).

## [5.3.1] - 2022-07-08

### Fixed

-   Backwards compatibility of `kksr_rate` and `kksr_vote` action hook.
-   Refactored the way fingerprint (IP Address) is calculated.
-   View templates now respect a view slug.
-   Shortcode now accepts a custom class attribute.
-   Touched CSS styles.

## [5.3.0] - 2022-05-26

### Added

-   Introduced the concept of addons.

### Updated

-   The plugin `init` action is now called as soon as the plugin is loaded instead of the `plugins_loaded` WordPress action.
-   Bumped WordPress version (6.0).

## [5.2.11] - 2022-05-21

### Fixed

-   Typo in `upgrader_process_complete` hook was fixed.

## [5.2.10] - 2022-05-07

### Fixed

-   The text domain files in the languages directory were not being loaded. (Fixes issue #120).

## [5.2.9] - 2022-02-24

### Updated

-   Bumped freemius SDK version to v2.4.3.
-   Tested upto v5.9.1.

### Fixed

-   Security fix.

## [5.2.8] - 2022-02-08

### Fixed

-   The priority for `the_content` filter has been set back to 10 to avoid issues with elementor.

## [5.2.7] - 2022-02-07

### Fixed

-   Checks for `get_the_ID()` before falling back to query vars.

## [5.2.6] - 2022-01-27

### Updated

-   jQuery is no more required.

## [5.2.5] - 2022-01-22

### Added

-   Support for custom rich snippets (ld_json) with binding.
-   Support for Gutenberg blocks using hooks.
-   Url and path utility functions.

### Fixed

-   The prefix function logic has been corrected.

## [5.2.4] - 2021-11-22

### Fixed

-   Removed unwanted html markup that caused errors.

## [5.2.3] - 2021-11-14

### Fixed

-   Removed whitespaces in ajax responses when a vote is casted to fix refresh issues.
-   Option value for a stack may be corrupted which is now ignored.

## [5.2.2] - 2021-11-07

### Fixed

-   Not enough arguments error that occured sometimes during `the_post` action hook has been fixed by marking the second argument as optional.

## [5.2.1] - 2021-11-06

### Fixed

-   Unique voting issue due to previous changes is now fixed.

## [5.2.0] - 2021-11-02

### Updated

-   Deprecated the use of migrations in favor of migrating posts when accessed.

## [5.1.4] - 2021-11-01

### Updated

-   Migrate 5 posts instead of 20 per batch.

### Fixed

-   Migrations for the same version were duplicated.

## [5.1.3] - 2021-11-01

### Updated

-   Migrate 20 posts instead of 50 per batch.

### Fixed

-   Migrations were not being processed continuously due to a javascript bug.

## [5.1.2] - 2021-11-01

### Fixed

-   Migrations now correctly run in the background when the frontend is open.

## [5.1.1] - 2021-11-01

### Updated

-   More detailed information is now displayed in `pending migrations` notice.

## [5.1.0] - 2021-10-31

### Added

-   Batched migrations. Posts are now migrated in batches in the background.

### Fixed

-   Bumped template code priority.

## [5.0.3] - 2021-10-11

### Updated

-   Freemius sdk upgraded to 2.4.2

### Fixed

-   Enforce casting of post id to int when calculating for meta box.
-   Disallowed check for regex expression when using find() in order to supress warning in PHP 8.

## [5.0.2] - 2021-10-11

### Fixed

-   Force legend to the default in order to override dangling v2 legend.

## [5.0.1] - 2021-10-10

### Fixed

-   Activation would not be executed when upgrading via wp org. Fixed by activating after plugin is loaded.

## [5.0.0] - 2021-10-09

### Release

-   Fresh codebase
