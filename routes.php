<?php
/**
 * Created by PhpStorm.
 * User: Glenn
 * Date: 2016-08-15
 * Time: 9:36 AM
 */

$app->get('/', function () use ($app) {
    $app->render('header.php');
    $app->render('footer.php');
});

$app->get('/employee/list',function () use ($app) {

});