<?php

global $project;
$project = 'mysite';

include(__DIR__ . '/local.conf.php');

// Set the site locale
i18n::set_locale('en_US');

SiteTree::enable_nested_urls();
Security::setDefaultAdmin('admin','password');