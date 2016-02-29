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

app.config(["$routeProvider",
    function ($routeProvider) {
        $routeProvider.
                when("/page1",{
                    templateUrl: "partials/page1.html",
                    controller: "myCtrl1"
        }).
                when("/page2",{
                    templateUrl: "partials/page2.html",
                    controller: "myCtrl2"
        }).
                otherwise({
                    redirectTo: "/page1"
        });
    }]);


