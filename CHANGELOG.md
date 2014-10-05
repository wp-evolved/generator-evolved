# Changelog

Releases are be numbered in the semantic versioning format:

`<major>.<minor>.<patch>`

And constructed with these guidelines:

* Breaking backwards compatibility bumps the major
* New additions without breaking backwards compatibility bumps the minor
* Bug fixes and misc changes bump the patch

For more information on semantic versioning, please visit http://semver.org/.

## v1.1.0 - October 5, 2014

* Added argument checker for @ key
* Added branch verification from Github archive
* Added 'latest' check when no branch is passed

## v1.0.0 - September 26, 2014

* Updated installer to remotely copy theme files from main [Evolved Theme](https://github.com/wp-evolved/evolved-theme) project
* Updated Gruntfile to match updates in Evolved Theme
* Updated instructions in Readme to match new setup

## v0.4.4 - August 9, 2014

* Removed duplicate bower template

## v0.4.3 - August 9, 2014

* NPM install still broken, maybe this'll fix it?

## v0.4.2 - August 9, 2014

* Fixed repository url, hopefully this fixes NPM install issue

## v0.4.1 - August 9, 2014

* Fixing ver issue w/ NPM. No real changes

## v0.4.0 - August 9, 2014

* Renamened generator to generator-wp-evolved
* Moved generator to the wp-evolved organization
* Updated all files and docs for new location and name

## v0.3.1 - August 8, 2014

* Removed Genesis Skeleton from bower dependencies
* Removed Genesis Skeleton dependencies from README

## v0.3.0 - August 1, 2014

* Made the project agnostic to Genesis (checks for an existing themes dir or prompts the user to enter one)
* Added default Neat settings to the _settings.scss file
* Added viewport meta info
* Removed pxtoem() function in favor of Bourbon em() function
* Removed pxtoper() function in favor of Sass percentage() function
* Removed inuit arrows in favor of Bourbon triangles
* Removed inuit truncate() mixin in favor of Bourbon's ellipsis() mixin
* Removed inuit box-sizing in favor of Neat's box-sizing
* Removed batch icon styles
* Removed default theme files (from /modules and /layout)
* Changed clearfix class to a silent placeholder
* Changed unstyled-list class to a silent placeholder
* Updated imagemin task to overwrite images rather than duplicate them
* Updated site-logo to link to home page

## v0.2.6 - July 31, 2014

* Fixed pagination markup output
* Fixed includes for post previews
* Added grunt colorguard task to build tasks
* Fixed scss file import order (for good this time) 

## v0.2.5 - June 11, 2014

* Added wp_nav_menu theme locations
* Added accessible skip to content link
* Added edit link for users
* Fixed a bug in the `category_id_class` function
* Fixed a bug in the `display_post_thumbnail` function
* Fixed a bug in the `grunt watch` task
* Fixed duplicate padding on lists
* Updated required versions of devDependencies
* Updated to use new `main` element

## v0.2.4 - May 4, 2014

Fixed improper Sass import order. Project dependencies *must* come before any project files.

## v0.2.3 - May 2, 2014

Fixed improper semicolon use.

## v0.2.2 - May 2, 2014

Fixed a bug for missing media-query mixin and added an example of how Bourbon's media mixin should be used instead.

## v0.2.1 - May 2, 2014

Fixed a bug for missing vendor mixin

## v0.2.0 - May 1, 2014

Updating for Sass v3.3, Bourbon v4.* and Neat v1.6.*.

**This is a backward incompatible change. Continue to use v0.1.* until you update Sass to v3.3 or later**

## v0.1.0 - May 1, 2014

Initial Release of the Evolution Generator for Genesis Skeleton - WordPress

Features:

* Yeoman generator makes installation (or updating) on an existing Genesis Skeleton project simple.
* Parent theme creates a unified base for all Genesis Skeleton projects without making too many design decisions.
* Child theme takes control of the project's specific design requirements utilizing Bourbon for Sass utilities and Neat for grid alignments.
* Utilizes Bower for easy dependency management.
* Utilizes Grunt for an integrated CLI workflow with Genesis Skeleton.
