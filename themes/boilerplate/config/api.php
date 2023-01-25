<?php

use Bond\Settings\Api;

// TODO enable method?

// Api::disable();

Api::changePrefix('api');

Api::disableHeader();
Api::disableDefaultRoutes();
Api::disableRootRoute();
Api::disableOembed();

// Api::onlyLoggedIn();
