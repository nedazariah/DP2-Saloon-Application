/*global angular*/
var app = angular.module("myApp", []);

app.controller("myCtrl", function ($scope, $http, $window) {
    "use strict";

    $scope.validate = function () {
        $scope.Warnings = [];
        var errors = 0;
        if ($scope.addStaffForm.staffName.$invalid) {
            $scope.Warnings.push("Please Enter Staff Name");
            errors += 1;
        }

        if ($scope.addStaffForm.staffDOB.$invalid) {
            $scope.Warnings.push("Please Enter Staff Date of Birth");
            errors += 1;
        } else {
            $scope.staffDOB = $scope.staffDOB.getFullYear() + "-" + ($scope.staffDOB.getMonth() + 1) + "-" + $scope.staffDOB.getDate();
        }

        if ($scope.addStaffForm.staffPhone.$invalid) {
            $scope.Warnings.push("Please Enter Staff Phone Number");
            errors += 1;
        }

        if ($scope.addStaffForm.staffEmail.$invalid) {
            $scope.Warnings.push("Please Enter A Valid Email");
            errors += 1;
        }

        if ($scope.addStaffForm.staffGender.$invalid) {
            $scope.Warnings.push("Please Select Staff Gender");
            errors += 1;
        }

        if ($scope.addStaffForm.staffRole.$invalid) {
            $scope.Warnings.push("Please Select Staff Role");
            errors += 1;
        }
        
        if ($scope.staffAdd === undefined) {
            $scope.staffAdd = "";
        }

        if (errors === 0) {
            var config = {
                method : "POST",
                url : "addstaff.php",
                data : {
                    'staffName' : $scope.staffName,
                    'staffDOB' : $scope.staffDOB,
                    'staffGender' : $scope.staffGender,
                    'staffPhone' : $scope.staffPhone,
                    'staffEmail' : $scope.staffEmail,
                    'staffRole' : $scope.staffRole,
                    'staffAdd' : $scope.staffAdd
                }
            };
            
            var request = $http(config);
            request.then(function (response) {
                $window.location.href= response.data;

            }, function (error) {
                $scope.Warnings.push(error.data);
            });
        }
    };
});
