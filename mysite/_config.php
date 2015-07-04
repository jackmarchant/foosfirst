<?php

global $project;
$project = 'mysite';

include(__DIR__ . '/local.conf.php');

// Set the site locale
i18n::set_locale('en_US');

SiteTree::enable_nested_urls();
Security::setDefaultAdmin('admin','password');

Director::set_environment_type('dev');

 SS_Log::add_writer(new SS_LogFileWriter('../silverstripe-errors.log'), SS_Log::ERR);