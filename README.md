Kunstmaan Bundles Standard Edition
==================================

Welcome to the Kunstmaan Bundles Standard Edition - a fully-functional CMS (content management system) based on Symfony2 that you can use as the skeleton for your websites.

This document contains information on how to download, install, and start using the Kunstmaan Bundles CMS.

1) Installing the Kunstmaan Bundles SE
----------------------------------------------------

As both the Kunstmaan Bundles and Symfony use [Composer][2] to manage its dependencies, the recommended way to create a new project is to use it.

If you don't have Composer yet, download it following the instructions on http://getcomposer.org/ or just run the following command:

    curl -s http://getcomposer.org/installer | php

Then, use the `create-project` command to generate a new Symfony application:

    php composer.phar create-project kunstmaan/bundles-standard-edition path/to/install -s dev

Composer will install the Kunstmaan Bundles CMS and all its dependencies under the `path/to/install` directory.


2) Checking and configuring your website
----------------------------------------

Before starting coding, make sure that your local system is properly configured for Symfony and the Kunstmaan Bundles.

Execute the `check.php` script from the command line:

    php app/check.php

The script returns a status code of `0` if all mandatory requirements are met, `1` otherwise.

Access the `config.php` script from a browser:

    http://localhost/path/to/app/web/config.php

If you get any warnings or recommendations, fix them before moving on.

You should also make sure you have [nodejs][3], Sass, Bower and Grunt installed.

    brew install node
    gem install sass # maybe you need sudo...
    npm install -g bower
    npm install -g grunt

3) Generating your website
--------------------------

First of, generate the bundle for your website.

    app/console kuma:generate:bundle
    
And create the database and fill it using the fixtures

    app/console doctrine:schema:create
    app/console doctrine:fixtures:load

Next up, generate the default website setup. This command will also create a simple home page and content page.

    app/console kuma:generate:default-site
    
If you want some more demo content (admin lists, sub pages, sitemap, contact page, ...) on the generated website, 
you should run the command below instead.

    app/console kuma:generate:default-site --demosite

To get started with Behat tests, you can generate custom tests for your admin interface by running the following.

    app/console kuma:generate:admin-tests

Now that all your code is generated, let's make sure all frontend assets are available

    bower install
    npm install
    grunt build
    app/console assets:install
    app/console assetic:dump


4) Browsing the CMS administration pages
----------------------------------------

Congratulations! You're now ready to use the Kunstmaan Bundles CMS. Browse to:

    http://localhost/path/to/app/en/admin

Log in using admin/admin.

5) Creating pages and pageparts
-------------------------------

Evey CMS needs some custom pages and custom page content blocks. We have two generators to help you creating these. First up, creating a new pagetype:

    app/console kuma:generate:page
    app/console doctrine:schema:update --force # Update the database (or use a migration)

Make sure to add the little piece of code the generator will mention at the end of the run. After this, you can add this new pagetype in the admin interface.

Creating pageparts works the same way:

    app/console kuma:generate:pagepart
    app/console doctrine:schema:update --force # Update the database (or use a migration)

You should be able to add this pagepart to your pages at this point.

6) Doing more than the default pages and pageparts
--------------------------------------------------

You can also generate a news area using the ArticleBundle. Or any section based on a list with detail view (FAQ, Lexicon, Blog, etc)

    app/console kuma:generate:article

Often you also have some entities that you need to administer (e.g. News authors)

    # Generate the entity
    app/console kuma:generate:entity

    # Generate an adminlist for this entity
    app/console kuma:generate:adminlist

And a Elastic Search bases search engine?

    app/console kuma:generate:searchpage


Enjoy!

[1]:  http://bundles.kunstmaan.be/documentation/getting-started
[2]:  http://getcomposer.org/
[3]:  http://nodejs.org/
