# Changelog

Releases are be numbered in the semantic versioning format:

`<major>.<minor>.<patch>`

And constructed with these guidelines:

* Breaking backwards compatibility bumps the major
* New additions without breaking backwards compatibility bumps the minor
* Bug fixes and misc changes bump the patch

For more information on semantic versioning, please visit http://semver.org/.

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