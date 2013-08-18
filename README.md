Kunstmaan Bundles Standard Edition [![Build Status](https://travis-ci.org/Kunstmaan/KunstmaanBundlesStandardEdition.png?branch=master)](https://travis-ci.org/Kunstmaan/KunstmaanBundlesStandardEdition)
==================================

Welcome to the Kunstmaan Bundles Standard Edition - a fully-functional CMS (content management system) based on Symfony2 that you can use as the skeleton for your websites.

This document contains information on how to download, install, and start using the Kunstmaan Bundles CMS. For a more detailed explanation, see the [Getting Started][1] chapter of the Kunstmaan Bundles Documentation.

1) Installing the Kunstmaan Bundles Standard Edition
----------------------------------------------------

As both the Kunstmaan Bundles and Symfony use [Composer][2] to manage its dependencies, the recommended way to create a new project is to use it.

If you don't have Composer yet, download it following the instructions on http://getcomposer.org/ or just run the following command:

    curl -s http://getcomposer.org/installer | php

Then, use the `create-project` command to generate a new Symfony application:

    php composer.phar create-project kunstmaan/bundles-standard-edition path/to/install

Composer will install Symfony and all its dependencies under the `path/to/install` directory.


2) Checking your System Configuration
-------------------------------------

Before starting coding, make sure that your local system is properly configured for Symfony and the Kunstmaan Bundles.

Execute the `check.php` script from the command line:

    php app/check.php

The script returns a status code of `0` if all mandatory requirements are met, `1` otherwise.

Access the `config.php` script from a browser:

    http://localhost/path/to/app/web/config.php

If you get any warnings or recommendations, fix them before moving on.

3) Browsing the CMS administration pages
----------------------------------------

Congratulations! You're now ready to use the Kunstmaan Bundles CMS. Browse using your broser to:

    http://localhost/path/to/app/en/admin

Log in using admin/admin.

Enjoy!

[1]:  http://bundles.kunstmaan.be/documentation/getting-started
[2]:  http://getcomposer.org/
