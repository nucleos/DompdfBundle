# Changelog

All notable changes to this project will be documented in this file, in reverse chronological order by release.

## 4.2.0 - 2024-05-22


-----

### Release Notes for [4.2.0](https://github.com/nucleos/NucleosDompdfBundle/milestone/11)

Feature release (minor)

### 4.2.0

- Total issues resolved: **0**
- Total pull requests resolved: **3**
- Total contributors: **3**

#### dependency

 - [550: Adding compatibility with dompdf 3.0](https://github.com/nucleos/NucleosDompdfBundle/pull/550) thanks to @ThomasLandauer
 - [547: Update dependency psalm/plugin-phpunit to ^0.19](https://github.com/nucleos/NucleosDompdfBundle/pull/547) thanks to @renovate[bot]

#### Bug

 - [544: Allow the use of callback in events](https://github.com/nucleos/NucleosDompdfBundle/pull/544) thanks to @kl3sk

## 4.1.0 - 2023-12-21


-----

### Release Notes for [4.1.0](https://github.com/nucleos/NucleosDompdfBundle/milestone/8)

Feature release (minor)

### 4.1.0

- Total issues resolved: **0**
- Total pull requests resolved: **6**
- Total contributors: **2**

#### dependency

 - [543: Bump to symfony ^6.4 || ^7.0](https://github.com/nucleos/NucleosDompdfBundle/pull/543) thanks to @core23
 - [540: Update dependency symfony/phpunit-bridge to v7](https://github.com/nucleos/NucleosDompdfBundle/pull/540) thanks to @renovate[bot]
 - [539: Update dependency matthiasnoback/symfony-dependency-injection-test to v5](https://github.com/nucleos/NucleosDompdfBundle/pull/539) thanks to @renovate[bot]
 - [536: Update dependency phpunit/phpunit to v10](https://github.com/nucleos/NucleosDompdfBundle/pull/536) thanks to @renovate[bot]

#### Enhancement

 - [541: Update tools ](https://github.com/nucleos/NucleosDompdfBundle/pull/541) thanks to @core23
 - [537: Drop support for PHP 8.0](https://github.com/nucleos/NucleosDompdfBundle/pull/537) thanks to @core23

## 3.1.2 - TBD

### Added

- Nothing.

### Changed

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.

## 3.1.1 - 2021-02-07


-----

### Release Notes for [3.1.1](https://github.com/nucleos/NucleosDompdfBundle/milestone/1)



### 3.1.1

- Total issues resolved: **0**
- Total pull requests resolved: **1**
- Total contributors: **1**

#### Documentation

 - [184: Improve docs](https://github.com/nucleos/NucleosDompdfBundle/pull/184) thanks to @ThomasLandauer

## 3.1.0

### Changes

### 🚀 Features

- Move configuration to PHP [@core23] ([#70])

### 📦 Dependencies

- Update `dompdf/dompdf` requirement from `^0.7 || ^0.8` to `^0.7 || ^0.8 || ^1.0.0` [@dependabot] ([#174])
- Add support for PHP 8 [@core23] ([#152])
- Drop support for PHP7.2 [@core23] ([#80])

## 3.0.0

### Changes

* Renamed namespace `Core23\DompdfBundle` to `Nucleos\DompdfBundle` after move to [@nucleos]

  Run

  ```
  $ composer remove core23/dompdf-bundle
  ```

  and

  ```
  $ composer require nucleos/dompdf-bundle
  ```

  to update.

  Run

  ```
  $ find . -type f -exec sed -i '.bak' 's/Core23\\DompdfBundle/Nucleos\\DompdfBundle/g' {} \;
  ```

  to replace occurrences of `Core23\DompdfBundle` with `Nucleos\DompdfBundle`.

  Run

  ```
  $ find -type f -name '*.bak' -delete
  ```

  to delete backup files created in the previous step.

## 2.6.0

### Changes

- Add missing strict file header [@core23] ([#48])
- Remove old symfony <4.2 code [@core23] ([#46])
- Removed explicit private visibility of services [@core23] ([#33])

### 🚀 Features

- Add support for symfony 5 [@core23] ([#40])
- Use symfony contracts [@core23] ([#27])

[#48]: https://github.com/nucleos/NucleosDompdfBundle/pull/48
[#46]: https://github.com/nucleos/NucleosDompdfBundle/pull/46
[#40]: https://github.com/nucleos/NucleosDompdfBundle/pull/40
[#33]: https://github.com/nucleos/NucleosDompdfBundle/pull/33
[#27]: https://github.com/nucleos/NucleosDompdfBundle/pull/27
[@nucleos]: https://github.com/nucleos
[@core23]: https://github.com/core23
[#174]: https://github.com/nucleos/NucleosDompdfBundle/pull/174
[#152]: https://github.com/nucleos/NucleosDompdfBundle/pull/152
[#80]: https://github.com/nucleos/NucleosDompdfBundle/pull/80
[#70]: https://github.com/nucleos/NucleosDompdfBundle/pull/70
[@dependabot]: https://github.com/dependabot
