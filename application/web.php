<?php
require_once 'core/model.php';
require_once 'core/view.php';
require_once 'core/controller.php';
require_once 'Router/Router.php';

$roles = [
    1 => [1], //user
    2 => [1,2],//admin
];
Router::setRoles($roles);
Router::route('/main', 'ShowProblemsController');
Router::route('/createproblem', 'CreateProblemController');
Router::route('/oncreateproblem', 'problemController');
Router::route('/', 'ShowProblemsController');
Router::route('/signout', 'SignController@signout');
Router::route('/signin', 'SignController');
Router::route('/login', 'AuthController');
Router::route('/register', 'AuthController@register');
Router::route('/signup', 'SignController@signup');
Router::middleware([
    Router::route('/edit', 'problemController@edit'),
    Router::route('/delete', 'problemController@delete')
],[2]);


Router::onRelocate();
