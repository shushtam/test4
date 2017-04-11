/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

angular.module('angtestApp')
        .controller('UserCtrl', function ($scope, $http, $routeParams) {
            this.awesomeThings = [
                'HTML5 Boilerplate',
                'AngularJS',
                'Karma'
            ];
            var errors;
            $scope.error = [];
            $http({
                method: 'GET',
                url: 'http://laravel.example.com/getusers',
                params: {userId: $routeParams.id},

            }).then(function successCallback(response) {
                //user = angular.fromJson(response.data);
                $scope.Name = response.data.dt.name;
                $scope.Email = response.data.dt.email;

            }, function errorCallback(response) {
                errors = response.data;
                for (i in errors) {
                    $scope.error.push(errors[i]);
                }
            });
            $scope.submit = function () {
                // userdt = angular.toJson(userdata);
                
                $http({
                    method: 'POST',
                    url: 'http://laravel.example.com/postusers',
                    data: {name: $scope.Name, email: $scope.Email, userId: $routeParams.id},
                }).then(function successCallback(response) {

                }, function errorCallback(response) {
                    errors = response.data;
                    for (i in errors) {
                        $scope.error.push(errors[i]);
                    }
                    
                });
            }
        });
