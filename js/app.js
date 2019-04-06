/*jslint white:true */
/*global angular */
/*
 * Solution for error message: 'angular' was used before it was defined by JSlint
 *  http://stackoverflow.com/questions/31390428/error-angular-was-used-before-it-was-defined-but-online-editors-able-to-outpu
 *
 */
var app = angular.module("myApp", []);
app.controller("myCtrl", function ($scope) {
    "use strict";
    $scope.dotClicked = false;
    $scope.iniClick = 0;
    $scope.memory = 0;
    $scope.answerStr = "";
    $scope.answer = 0;
    $scope.isNumber = false;
    $scope.memoryStr = "";
    $scope.memoryClick = false;
    $scope.last = "";
    
    $scope.clickZero = function () {
        if ($scope.iniClick == 0) {
            $scope.answerStr = "0";
        } else {
            $scope.answerStr += "0";
        }
        $scope.iniClick++;
        $scope.isNumber = true;
        
    };
    $scope.clickOne = function () {
        if ($scope.iniClick == 0) {
            $scope.answerStr = "1";
        } else {
            $scope.answerStr  += "1";
        }
        /*$scope.answerStr += "1";*/
        $scope.iniClick++;
        $scope.isNumber = true;
    };
    $scope.clickTwo = function () {
        if ($scope.iniClick == 0) {
            $scope.answerStr= "2";
        } else {
            $scope.answerStr += "2";
        }
        
        $scope.iniClick++;
        $scope.isNumber = true;
        
    };
    $scope.clickThree = function () {
        if ($scope.iniClick == 0) {
            $scope.answerStr = "3";
        } else {
            $scope.answerStr += "3";
        }
        
        $scope.iniClick++;
        $scope.isNumber = true;
        
    };
    $scope.clickFour = function () {
        if ($scope.iniClick == 0) {
            $scope.answerStr = "4";
        } else {
            $scope.answerStr += "4";
        }
        
        $scope.iniClick++;
        $scope.isNumber = true;
        
    };
    $scope.clickFive = function () {
       if ($scope.iniClick == 0) {
            $scope.answerStr = "5";
        } else {
            $scope.answerStr += "5";
        }
        
        $scope.iniClick++;
        $scope.isNumber = true;
        
    };
    $scope.clickSix = function () {
       if ($scope.iniClick == 0) {
            $scope.answerStr = "6";
        } else {
            $scope.answerStr += "6";
        }
        
        $scope.iniClick++;
        $scope.isNumber = true;
        
    };
    $scope.clickSeven = function () {
        if ($scope.iniClick == 0) {
            $scope.answerStr = "7";
        } else {
            $scope.answerStr += "7";
        }
        
        $scope.iniClick++;
        $scope.isNumber = true;
        
    };
    $scope.clickEight = function () {
        if ($scope.iniClick == 0) {
            $scope.answerStr = "8";
        } else {
            $scope.answerStr += "8";
        }
        
        $scope.iniClick++;
        $scope.isNumber = true;
        
    };
    $scope.clickNine = function () {
        if ($scope.iniClick == 0) {
            $scope.answerStr = "9";
        } else {
            $scope.answerStr += "9";
        }
        
        $scope.iniClick++;
        $scope.isNumber = true;
        
    };
    $scope.clickNum = function (input) {
        if ($scope.iniClick == 0) {
            $scope.answerStr = input.currentTarget.value;
        } else {
            $scope.answerStr += input.currentTarget.value;
        }
        
        $scope.iniClick++;
        $scope.isNumber = true;
        
    };
    $scope.clickPlus = function () {
        if ($scope.isNumber == true) {
            $scope.answerStr += "+";
        }
        $scope.isNumber = false;
        $scope.dotClicked = false;
    }
    $scope.clickMinus = function () {
        if ($scope.isNumber == true) 
            $scope.answerStr += "-";
        $scope.isNumber = false;
        $scope.dotClicked = false;
        
    }
    $scope.clickMultiply = function () {
        if ($scope.isNumber == true) 
            $scope.answerStr += "*";
        $scope.isNumber = false;
        $scope.dotClicked = false;
    }
    $scope.clickDivide = function () {
        if ($scope.isNumber == true) 
            $scope.answerStr += "/";
        $scope.isNumber = false;
        $scope.dotClicked = false;
    }
    $scope.clickDot = function () {
        if ($scope.dotClicked == false && $scope.isNumber == true) {
            $scope.answerStr += ".";
            $scope.dotClicked = true;
            $scope.isNumber = false;
        }
    }
    $scope.clickPercentage = function () {
        if ($scope.isNumber == true) {
           $scope.answerStr += "%";
        }
    }
    $scope.allClear = function () {
        $scope.answerStr = "";
        $scope.answer = 0;
        $scope.iniClick = 0;
        $scope.dotClicked = false;
        $scope.isNumber = false;
    }
    $scope.clickClear = function(){
        $scope.answerStr = $scope.answerStr.slice(0,-1);
        if ($scope.answerStr.length === 0){
            $scope.isNumber = false;
        }else if ('0123456789'.includes($scope.answerStr.slice(-1))){
            $scope.isNumber = true;
            $scope.dotClicked = false;
        }else if('+-*/'.includes($scope.answerStr.slice(-1))){
            $scope.isNumber = false;

        }else if('.'.includes($scope.answerStr.slice(-1))){
            $scope.dotClicked = true;
            $scope.isNumber = false;
        }
            
    }
    $scope.clickMRPlus = function () {
        $scope.memoryStr += "+" + $scope.answerStr;
        $scope.memoryClick = true;
        $scope.iniClick = 0;
        
    }
    $scope.clickMRMinus = function () {
        $scope.memoryStr += "-" + $scope.answerStr;
        $scope.memoryClick = true;
        $scope.iniClick = 0;
        
    }
    $scope.clickMR = function () {
        $scope.memory = eval($scope.memoryStr);
    }
    $scope.clickMC = function(){
        $scope.memory = 0;
        $scope.memoryStr = "";
    }
    $scope.clickEqual = function () {
        $scope.answer = eval($scope.answerStr.replace("%", "/100"));
    }

});
