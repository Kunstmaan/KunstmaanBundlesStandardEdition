#!/bin/bash

export LC_ALL="en_US.UTF-8"
export LANG="en_US.UTF-8"

phpdismod xdebug

bin/console doctrine:database:create --env=docker
bin/console doctrine:schema:create --env=docker
bin/console doctrine:fixtures:load --env=docker
bin/console assets:install --symlink --env=docker
chmod -R 777 var/

`$1`
