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

    var url1 = "https://graph.facebook.com/cocacolabelgium/feed?fields=message,created_time,picture&since=2016-01-01&access_token=438252053041957|IHjpcd9zGhWesX5EuwO2_77pOH8&callback=JSON_CALLBACK";
    $http.jsonp(url1).then(function (response) {
        $scope.fbData = response.data.data;
        console.log($scope.fbData);
    });

    $scope.orderFBByMe = function (x) {
        $scope.myOrderFBBy = x;
    };
});

controllers.controller("leaguesCtrl", function ($scope, $http, $rootScope) {
    var leaguesUrl = "http://api.football-data.org/v1/soccerseasons";
    
    $scope.filterValues = [394,396,398,399,401]; //id's van Bundesliga, Ligue1, Premier League, Primera Division, Seria A
    $scope.leagueFilter = function(value){//filter om enkel de competities in $scope.filterValue te weergeven
        return ($scope.filterValues.indexOf(value.id)!==-1);
    };

    $http({
        method: "GET",
        url: leaguesUrl,
        headers: {"X-Auth-Token": $rootScope.footballAuth}
    }).then(function (response) {
        $scope.leaguesData = response.data;
        console.log(response.data);
    });
});

controllers.controller("tableCtrl", function ($scope, $http, $rootScope, $routeParams) {
    var leaguesUrl = "http://api.football-data.org/v1/soccerseasons";
    
    $scope.filterValues = [394,396,398,399,401]; //id's van Bundesliga, Ligue1, Premier League, Primera Division, Seria A
    $scope.leagueFilter = function(value){//filter om enkel de competities in $scope.filterValue te weergeven
        return ($scope.filterValues.indexOf(value.id)!==-1);
    };

    $http({
        method: "GET",
        url: leaguesUrl,
        headers: {"X-Auth-Token": $rootScope.footballAuth}
    }).then(function (response) {
        $scope.leaguesData = response.data;
        console.log(response.data);
    });
    
    var param = $routeParams.leagueId;
    
    var regex = /.*?(\d+)$/;
    
    var url2 = "http://api.football-data.org/v1/soccerseasons/" + param + "/leagueTable";

    $http({
        method: "GET",
        url: url2,
        headers: {"X-Auth-Token": $rootScope.footballAuth}
    }).then(function (response) {
        $scope.leaguetableData = response.data;

        for (i = 0; i < $scope.leaguetableData.standing.length; i++) { //teamId toevoegen aan object
            var teamId = regex.exec($scope.leaguetableData.standing[i]._links.team.href);
            $scope.leaguetableData.standing[i].teamId = teamId[1];
        }
        console.log(response.data);
    });
});

controllers.controller("teamCtrl", function ($scope, $http, $routeParams, $rootScope) {
    var param = $routeParams.teamId;
    var urlTeam = "http://api.football-data.org/v1/teams/" + param + "";
    var urlSpelers = "http://api.football-data.org/v1/teams/" + param + "/players";

    $scope.orderDir = true;

    $http({
        method: "GET",
        url: urlTeam,
        headers: {"X-Auth-Token": $rootScope.footballAuth}
    }).then(function (response) {
        $scope.teamData = response.data;
    });

    $http({
        method: "GET",
        url: urlSpelers,
        headers: {"X-Auth-Token": $rootScope.footballAuth}
    }).then(function (response) {
        $scope.spelersData = response.data.players;
    });

    $scope.orderPlayersByMe = function (x) {
        $scope.orderPlayersBy = x;
        $scope.orderDir = !$scope.orderDir;
    };
});

