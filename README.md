# <h1 style="text-align: center;">Magento 2 Module AnassTouatiCoder ReferrerTracker</h1>


    ``anasstouaticoder/magento2-module-referrer-tracker``

 - [Main Functionalities](#markdown-header-main-functionalities)
 - [Installation](#markdown-header-installation)
 - [Configuration](#markdown-header-configuration)
 - [Specifications](#markdown-header-specifications)
 - [Attributes](#markdown-header-attributes)


## Main Functionalities
Extension for tracking external Referrers coming from socials medai or marketplaces

## Installation
\* = in production please use the `--keep-generated` option

### Type 1: Zip file

 - Unzip the zip file in `app/code/AnassTouatiCoder`
 - Enable the module by running `php bin/magento module:enable AnassTouatiCoder_ReferrerTracker`
 - Apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`

### Type 2: Composer

 - Install the module composer by running `composer require anasstouaticoder/magento2-module-referrer-tracker`
 - enable the module by running `php bin/magento module:enable AnassTouatiCoder_ReferrerTracker`
 - apply database updates by running `php bin/magento setup:upgrade`
 - Flush the cache by running `php bin/magento cache:flush`

## Configuration
- In Back Office:

-To enable tracking customer registration, go to Stores => Configuration => ATOUATI Tools => Customer Registration and select Yes then save.
-To enable tracking customer when they passe a new order, go to Stores => Configuration => ATOUATI Tools => Order Success then select Yes then save.
-If you want to exclude domains then, go to Stores => Configuration => ATOUATI Tools => Exclude External Domains and add some domains then save.

- Using CLI:
-Enable tracking customers when they register in the website 
: `bin/magento config:set 'anasstouaticoder_trackreferrerorigin/general/order' 1`

-Enable tracking customers when they passe a new order in the website
: `bin/magento config:set 'anasstouaticoder_trackreferrerorigin/general/order' 1`


## Specifications

## Attributes
- Flat Models:
-sales_order => atouati_external_origin
-sales_order_grid => atouati_external_origin

- EAV Models:
-Customer entity => atouati_external_origin
