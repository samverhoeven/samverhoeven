var app = angular.module('myApp', [
    "ngRoute",
    "controllers"
]);

app.run(function ($rootScope) {
    $rootScope.firstName = 'John';
    $rootScope.lastName = 'Doe';
    $rootScope.fullName = function () {
        return $rootScope.firstName + " " + $rootScope.lastName;
    };
    $rootScope.footballAuth = "ca3b6f7b377b44ab9b04d3cdc20fc3ca";
});

app.filter('myFormat', function () {
    return function (x) {
        var i, c, txt = "";
        x = x.split("");
        for (i = 0; i < x.length; i++) {
            c = x[i];
            if (i % 2 == 0) {
                c = c.toUpperCase();
            }
            txt += c;
        }
        return txt;
    };
});

app.config(function ($routeProvider) {
    $routeProvider.
            when("/test", {
                templateUrl: "partials/test.html",
                controller: "myCtrl1"
            }).
            when("/competities", {
                templateUrl: "partials/competities.html",
                controller: "leaguesCtrl"
            }).
            when("/competities/:leagueId", {
                templateUrl: "partials/rangschikking.html",
                controller: "tableCtrl"
            }).
            when("/teams/:teamId", {
                templateUrl: "partials/teaminfo.html",
                controller: "teamCtrl"
            }).
            otherwise({
                redirectTo: "/competities"
            });
});


