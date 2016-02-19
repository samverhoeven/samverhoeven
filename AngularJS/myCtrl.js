app.controller('myCtrl', function ($scope, $location, $http) {
    $scope.myUrl = $location.absUrl();
    
    $http.get("http://www.w3schools.com/angular/customers.php").then(function(response) {
        $scope.myData = response.data.records;
        console.log($scope.myData);
    });
    
    var url = "https://graph.facebook.com/cocacolabelgium/feed?fields=message,created_time,picture&since=2016-01-01&access_token=438252053041957|IHjpcd9zGhWesX5EuwO2_77pOH8&callback=JSON_CALLBACK";
    $http.jsonp(url).then(function(response) {
        $scope.fbData = response.data.data;
        console.log($scope.fbData);
    });
    
    $scope.firstName = "John";
    $scope.lastName = "Doe";
    $scope.person = {firstName: "Sam", lastName: "Verhoeven"};
    $scope.getal = 1;
    $scope.numbers = [4, 8, 68, 99, 105];
    $scope.names = [
        {name:'Jani',country:'Norway'},
        {name:'Hege',country:'Sweden'},
        {name:'Kai',country:'Denmark'}
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
    $scope.orderByMe = function(x){
        $scope.myOrderBy = x;
    };
    $scope.orderFBByMe = function(x){
        $scope.myOrderFBBy = x;
    };
    $scope.countFunction = function(){
        $scope.count++;
    };
    $scope.toggleShow = function(){
        $scope.visible = !$scope.visible;
    };

    console.log($scope);
});


