#!/usr/bin/env bash

source functions.sh

# ======================================================================================================================
echo_title "First of all we are checking the software environment"
echo "Check required programs. If you meet permission error, try run this script with $(tput setaf 3)sudo$(tput setaf 7)!"
# Check NodeJS is exist
if [[ $(program_is_installed node) == 0 ]]; then
    echo "NodeJS is required, but it is not installed! Please install it before starting setup."
    exit 1
else
    echo "$(echo_pass NodeJS)"
fi
# Check gem is exist
if [[ $(program_is_installed gem) == 0 ]]; then
    echo "RubyGems is required, but it is not installed! Please install it before starting setup. Help: https://rubygems.org/pages/download"
    exit 1
else
    echo "$(echo_pass RubyGems)"
fi
# Check bundler is exist
if [[ $(program_is_installed bundler) == 0 ]]; then
    echo "Bundler is required, but it is not installed! Please install it before starting setup. Help: http://bundler.io/"
    exit 1
else
    echo "$(echo_pass Bundler)"
fi

npms=("bower" "gulp" "uglifyjs" "uglifycss")
for npm in "${npms[@]}"
do
    if [[ $(program_is_installed $npm) == 0 ]]; then
        echo "Try to install $npm npm package..."
        npm install -g $npm
    else
        echo "$(echo_pass $npm)"
    fi
done

# ======================================================================================================================
echo_title "Run 'app/console kuma:generate:bundle' command..."
app/console kuma:generate:bundle

echo_title "Run 'app/console kuma:generate:default-site' command..."
app/console kuma:generate:default-site

echo_title "Run 'app/console doctrine:database:create' command..."
app/console doctrine:database:create --if-not-exists

echo_title "Build database..."
echo "You can choice a workflow. You want to use database migration (create migration file and run it - preferred) OR just run 'doctrine:schema:create' command."
read -p "Do you want to use database migration? (Y/n) " -n 1 -r
echo
if [[ $REPLY =~ ^[nN]$ ]]
then
    app/console doctrine:schema:create
else
    app/console doctrine:migrations:diff
    app/console doctrine:migrations:migrate --no-interaction
fi

echo_title "Load fixtures"
app/console doctrine:fixtures:load

## Optionaly: create admin behat tests
echo_title "Run 'app/console kuma:generate:admin-tests' command..."
app/console kuma:generate:admin-tests

# ======================================================================================================================
echo_title "Install other dependencies... (Bundler, NPM, Bower, Gulp)"
bundle install
npm install
bower install
gulp build

# ======================================================================================================================
echo_title "Install and dump assets"
app/console assets:install --symlink
app/console assetic:dump
app/console assetic:dump -e prod
