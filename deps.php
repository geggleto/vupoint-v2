<?php
/**
 * Created by PhpStorm.
 * User: Glenn
 * Date: 2016-08-15
 * Time: 9:35 AM
 */

$app->container->singleton('db', function ($c) {
    return new VuPoint\Core\Database();
});

$app->view()->setTemplatesDirectory(__DIR__."/templates");