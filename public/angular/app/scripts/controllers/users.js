/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


angular.module('angtestApp')
        .controller('UsersCtrl', function ($scope, $http, ModalService, UserService) {
            this.awesomeThings = [
                'HTML5 Boilerplate',
                'AngularJS',
                'Karma'
            ];
            var users;
            $scope.x = 100;
            $scope.user = [];
            $scope.data = [];
            $scope.itemsPerPage = 10;
            $scope.viewby = 10;
            $http({
                method: 'GET',
                url: 'http://laravel.example.com/users',
                headers: {
                    //'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;',
                    //'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
            }).then(function successCallback(response) {

                users = angular.fromJson(response.data);
                for (i in users) {
                    $scope.data.push(users[i]);
                    $scope.totalItems = $scope.data.length;
                    $scope.currentPage = 1;
                    $scope.itemsPerPage = $scope.viewby;
                    $scope.maxSize = 10; //Number of pager buttons to show

                }
            }, function errorCallback(response) {
                console.log(0);
            });
            $scope.setPage = function (pageNo) {
                $scope.currentPage = pageNo;
            };
            $scope.pageChanged = function () {
                console.log('Page changed to: ' + $scope.currentPage);
            };
            $scope.setItemsPerPage = function (num) {
                $scope.itemsPerPage = num;
                $scope.currentPage = 1; //reset to first paghe
            }
            $scope.showDetails = function (item) {
                UserService.set(item);
                $http({
                    method: 'GET',
                    url: 'http://laravel.example.com/getusers',
                    params: {userId: item},
                }).then(function successCallback(response) {
                    user = angular.fromJson(response.data);
                    $scope.Name = response.data.dt.name;
                    $scope.Email = response.data.dt.email;
                    $scope.role = response.data.dt.role;
                    $scope.ctime = response.data.dt.created_at;


                }, function errorCallback(response) {
                });
                ModalService.showModal({

                    templateUrl: "modal.html",
                    controller: "ModalController"
                }).then(function (modal) {

                    //it's a bootstrap element, use 'modal' to show it
                    modal.element.modal();
                    modal.close.then(function (result) {
                    });
                });
            }
        });
angular.module('angtestApp').controller('ModalController', function ($scope, $http, close, UserService) {
    $http({
        method: 'GET',
        url: 'http://laravel.example.com/getusers',
        params: {userId: UserService.get()},
    }).then(function successCallback(response) {
        user = angular.fromJson(response.data);
        ;
        $scope.Name = response.data.dt.name;
        $scope.Email = response.data.dt.email;
        $scope.role = response.data.dt.role;
        $scope.ctime = response.data.dt.updated_at;


    }, function errorCallback(response) {
    });
    $scope.close = function (result) {
        close(result, 500); // close, but give 500ms for bootstrap to animate
    };
});


angular.module('angtestApp').factory('UserService', function () {
    var x;
    return {
        set: function (it) {
            this.x = it;
        },
        get: function () {
            return this.x;
        }
    };

});