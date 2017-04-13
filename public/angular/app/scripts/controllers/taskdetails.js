/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


angular.module('angtestApp')
        .controller('TaskDetailsCtrl', function ($scope, $http, $routeParams) {
            var exist_ids;
            $http({
                method: 'GET',
                url: 'http://laravel.example.com/gettasks',
            }).then(function successCallback(response) {
                exist_ids = [];
                $scope.task = response.data.dt[$routeParams.taskid];
                for (i in  $scope.task.users)
                    exist_ids.push($scope.task.users[i].id);
                $http({
                    method: 'GET',
                    url: 'http://laravel.example.com/users',
                }).then(function successCallback(response) {
                    $scope.users = response.data;
                    for (var j = 0; j < exist_ids.length; j++) {
                        for (user in $scope.users) {

                            if ($scope.users[user].id == exist_ids[j])
                            {
                                delete $scope.users[user];
                                //users=users.splice(user,1);

                            }
                        }
                    }
                }, function errorCallback(response) {
                });
            }, function errorCallback(response) {
            });
            $scope.select2Options = {
                'multiple': true,
            };
            $scope.select_user = [];
            $scope.change = function () {
                //   console.log($scope.select_user);
            }
            $scope.addUsers = function () {
                if ($scope.select_user.length == 0) {
                    angular.element(document.querySelector('.select_error')).addClass('select_visible');
                } else {
                    $('.select').find("li.select2-search-choice").hide();
                    angular.element(document.querySelector('.select_error')).removeClass('select_visible');
                    for (var j = 0; j < $scope.select_user.length; j++) {
                        for (user in $scope.users) {
                            if ($scope.users[user].id == $scope.select_user[j])
                            {
                                $scope.task.users.push($scope.users[user]);
                                delete $scope.users[user];
                            }
                        }
                    }
                    $http({
                        method: 'POST',
                        url: 'http://laravel.example.com/addtask',
                        data: {task_id: $scope.task.id, users: $scope.select_user}
                    }).then(function successCallback(response) {

                    }, function errorCallback(response) {
                    });
                }
            }
            $scope.removeUser = function (remove_id) {
                $http({
                    method: 'GET',
                    url: 'http://laravel.example.com/removeuser',
                    params: {userId: remove_id, task_id: $scope.task.id},
                }).then(function successCallback(response) {
                    $http({
                        method: 'GET',
                        url: 'http://laravel.example.com/getusers',
                        params: {userId: remove_id},
                    }).then(function successCallback(response) {
                        remove_user = response.data.dt;
                        for (var i = 0; i < $scope.task.users.length; i++) {
                            if ($scope.task.users[i].id == remove_id) {
                                $scope.task.users.splice(i, 1);
                            }
                        }

                        $scope.users.push(remove_user);

                    }, function errorCallback(response) {
                    });
                }, function errorCallback(response) {
                });

            }

        });