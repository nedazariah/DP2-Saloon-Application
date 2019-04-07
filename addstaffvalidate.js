/*global angular*/
var app = angular.module("myApp", []);

app.controller("myCtrl", function ($scope) {
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

        if (errors === 0) {
            $scope.Warnings.push($scope.staffName);
            $scope.Warnings.push($scope.staffDOB);
            $scope.Warnings.push($scope.staffGender);
            $scope.Warnings.push($scope.staffPhone);
            $scope.Warnings.push($scope.staffEmail);
            $scope.Warnings.push($scope.staffRole);
            $scope.Warnings.push($scope.staffAdd);
        }
    };
});
