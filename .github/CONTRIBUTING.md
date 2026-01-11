---
title: Contributing
---

> Parts of this guide are taken from [converge's contribution guide](https://github.com/convergephp/documentations/blob/master/v1/framework/07-contributing.md), and it served as very useful inspiration.

## Reporting bugs

If you find a bug in Laravel Extra Boost, please submit a pull request with the fix. **I do not accept bug reports through issues** - only pull requests are welcome. Before submitting a PR, please search the [existing pull requests](https://github.com/akrista/laravel-extra-boost/pulls?q=is%3Apr) to see if the bug has already been addressed.

When submitting a pull request for a bug fix, please include a "reproduction repository" in your PR description. **Please do not link to your actual project**, what we need instead is a _minimal_ reproduction in a fresh project without any unnecessary code. This means it doesn't matter if your real project is private / confidential, since we want a link to a separate, isolated reproduction. This allows me to review and merge the fix much quicker. **Pull requests without reproduction repositories will be automatically closed and not reviewed if this is missing, to preserve maintainer time and to ensure the process is fair for those who put effort into contributing.** If you believe a reproduction repository is not suitable for the fix, which is a very rare case, you may still submit the PR but please explain it well. 

Remember, pull requests with bug fixes are created in the hope that others with the same problem will be able to collaborate with you on solving it. Do not expect that the pull request will automatically see any activity or that others will jump to fix it. Creating a pull request with a fix serves to help yourself and others start on the path of solving the problem.

## Development of new features

If you would like to propose a new feature or improvement to Laravel Extra Boost, you may use my [discussion form](https://github.com/akrista/laravel-extra-boost/discussions) hosted on GitHub. If you are intending on implementing the feature yourself in a pull request, I advise you to mention `@akrista` in your feature discussion beforehand and ask if it is suitable for the package to prevent wasting your time.

## Developing with a local copy of Laravel Extra Boost

If you want to contribute to the Laravel Extra Boost package, then you may want to test it in a real Laravel project:

- Fork [the GitHub repository](https://github.com/akrista/laravel-extra-boost) to your GitHub account.
- Create a Laravel app locally.
- Clone your fork in your Laravel app's root directory.
- In the `/packages/laravel-extra-boost` directory, create a branch for your fix, e.g. `fix/error`.

Install the packages in your app's `composer.json`:

```json
{
    // ...
    "require": {
        "akrista/laravel-extra-boost": "*",
    },
    "minimum-stability": "dev",
    "repositories": [
        {
            "type": "path",
            "url": "packages/*"
        }
    ],
    // ...
}
```

Now, run `composer update`.

Once you're finished making changes, you can commit them and submit a pull request to [the GitHub repository](https://github.com/akrista/laravel-extra-boost).

## Security vulnerabilities

If you discover a security vulnerability within Laravel Extra Boost, please email the maintainer via [info@notakrista.com](mailto:info@notakrista.com). All security vulnerabilities will be promptly addressed.