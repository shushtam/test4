'use strict';

/**
 * @ngdoc overview
 * @name angtestApp
 * @description
 * # angtestApp
 *
 * Main module of the application.
 */
angular
  .module('angtestApp', [
    'ngAnimate',
    'ngAria',
    'ngCookies',
    'ngMessages',
    'ngResource',
    'ngRoute',
    'ngSanitize',
    'ngTouch',
    'ui.bootstrap',
    'angularModalService',
    'ngDragDrop',
    'ngDraggable',
    'rt.select2',
    'ui.select2'
  ])
  .config(function ($routeProvider) {
    $routeProvider
      .when('/', {
        templateUrl: 'views/main.html',
        controller: 'MainCtrl',
        controllerAs: 'main'
      })
      .when('/about', {
        templateUrl: 'views/about.html',
        controller: 'AboutCtrl',
        controllerAs: 'about'
      })
      .when('/users', {
        templateUrl: 'views/users.html',
        controller: 'UsersCtrl',
        controllerAs: 'users'
      })
       .when('/users/:id', {
        templateUrl: 'views/user.html',
        controller: 'UserCtrl',
        controllerAs: 'user'
      })
       .when('/tasks', {
        templateUrl: 'views/tasks.html',
        controller: 'TaskCtrl',
        controllerAs: 'task'
      })
        .when('/taskdetails/:taskid', {
        templateUrl: 'views/task_details.html',
        controller: 'TaskDetailsCtrl',
        controllerAs: 'taskdetails'
      })
      .otherwise({
        redirectTo: '/'
      });
  });
