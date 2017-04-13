/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

angular.module('angtestApp')
        .controller('TaskCtrl', function ($scope, $http) {
            $http({
                method: 'GET',
                url: 'http://laravel.example.com/gettasks',
            }).then(function successCallback(response) {
                $scope.tasks = response.data.dt;

            }, function errorCallback(response) {
            });
            $scope.onDragComplete = function (data, event) {

            };
            $scope.onDropSuccess = function (data, event, target) {
                var task_id = $(event.element[0]).attr('data-task-id');
                var user_id = $(event.element[0]).attr('data-user-id');
                var target_task = $scope.tasks[target].users;
                var users = $scope.tasks[task_id].users;
                var duplicate = false;

                for (var i = 0; i < target_task.length; i++) {
                    if (target_task[i].id == user_id) {
                        duplicate = true;
                    }
                }
                if (duplicate == false) {
                    for (var i = 0; i < users.length; i++) {
                        if (users[i].id == user_id) {
                            users.splice(i, 1);
                        }
                    }
                    target_task.push(data);
                    $http({
                        method: 'POST',
                        url: 'http://laravel.example.com/updatetasks',
                        data: {user_id: user_id, task_id: task_id, newtask_id: target},
                    }).then(function successCallback(response) {

                    }, function errorCallback(response) {
                    });
                }

            };
        });


