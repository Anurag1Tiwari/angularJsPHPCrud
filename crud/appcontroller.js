var app = angular.module("myShoppingList", []); 
app.controller("myCtrl", function($scope,$http) {
    $http.get("api/getList.php").then(function(response) {
        $scope.users = response.data.list;
    });
    
    $scope.loadData = function () {
        
        $http.get('api/getList.php').then(function (response) {
            $scope.users = response.data.list;           
        });
    };

    // $scope.$watch( function () {

    //     $scope.loadData();

    // });

    $('#modalAdd, #modalEdit').on('hidden.bs.modal', function (e) {
       $scope.errortext="";
    })

   //add Users
    $scope.addItem = function (user) {
        console.log($scope.user);
        $http.post('api/addUser.php', $scope.user).then(function (response) {
            $scope.errortext=response.data.message;
            $scope.loadData();
        });      
       
    }
    //Edit Users
    $scope.editItem = function (x,y) {

       $scope.user=$scope.users[y];
       console.log($scope.user);
    }
    //Update Users
    $scope.updateItem1 = function(user){
        console.log(user);

        $http.put('api/update.php', $scope.user).then(function (response) {
            $scope.msg = response.data.message;
            $scope.errortext="User updated successfully";
        });
        
    }
    //Remove Users
    $scope.removeItem = function (x, y) {
        console.log(x);
        if(confirm("Really want to delete?")){

            $http.delete('api/delete.php?user_id=' + x).then(function (response) {
                alert("User has been deleted successfully");
                //$scope.users.splice(y, 1);
                $scope.loadData();
            });
            
            
        }
    }
});