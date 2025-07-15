<?php

/*
|--------------------------------------------------------------------------
| Test Bootstrap
|--------------------------------------------------------------------------
|
| This file is loaded before any tests are run to ensure environment
| variables are properly set.
|
*/

// Set NODE_PATH for tests if not already set
if (empty(getenv('NODE_PATH'))) {
    putenv('NODE_PATH=/usr/local/lib/node_modules:/node_modules');
}
