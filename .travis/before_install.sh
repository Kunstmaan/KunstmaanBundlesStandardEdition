#!/usr/bin/env bash

# Disable XDebug
phpenv config-rm xdebug.ini || exit $?
# Create build cache directory
mkdir -p \"${BUILD_CACHE_DIR}\" || exit $?

composer self-update --stable || exit $?
