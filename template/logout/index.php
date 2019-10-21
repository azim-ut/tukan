<?php

use core\manager\UserManager;

UserManager::logout();
header("Location: /");