var controllers = angular.module("controllers", []);

controllers.controller('myCtrl1', function ($scope, $location, $http) {
    $scope.myUrl = $location.absUrl();

    $http.get("http://www.w3schools.com/angular/customers.php").then(function (response) {
        $scope.myData = response.data.records;
        console.log($scope.myData);
    });
    $scope.firstName = "John";
    $scope.lastName = "Doe";
    $scope.person = {firstName: "Sam", lastName: "Verhoeven"};
    $scope.getal = 1;
    $scope.numbers = [4, 8, 68, 99, 105];
    $scope.names = [
        {name: 'Jani', country: 'Norway'},
        {name: 'Hege', country: 'Sweden'},
        {name: 'Kai', country: 'Denmark'}
    ];
    $scope.count = 0;
    $scope.visible = false;

    $scope.fullName = function () {
        return $scope.firstName + " " + $scope.lastName;
    };
    $scope.arraySum = function (array) {
        var total = 0;
        for (var i = 0; i < array.length; i++) {
            total += array[i];
        }
        return total;
    };
    $scope.orderByMe = function (x) {
        $scope.myOrderBy = x;
    };
    $scope.countFunction = function () {
        $scope.count++;
    };
    $scope.toggleShow = function () {
        $scope.visible = !$scope.visible;
    };

    console.log($scope);
});

controllers.controller("myCtrl2", function ($scope, $http) {
    var url1 = "https://graph.facebook.com/cocacolabelgium/feed?fields=message,created_time,picture&since=2016-01-01&access_token=438252053041957|IHjpcd9zGhWesX5EuwO2_77pOH8&callback=JSON_CALLBACK";
    $http.jsonp(url1).then(function (response) {
        $scope.fbData = response.data.data;
        console.log($scope.fbData);
    });

    $scope.orderFBByMe = function (x) {
        $scope.myOrderFBBy = x;
    };

    var url2 = "http://api.football-data.org/v1/soccerseasons/398/teams?callback=JSON_CALLBACK";

    $http({
        method: "GET",
        url: url2,
        headers: {"X-Auth-Token": "ca3b6f7b377b44ab9b04d3cdc20fc3ca"}
    }).then(function (response) {
        $scope.footballData = response.data.teams;
        console.log($scope.footballData);
    });
});


