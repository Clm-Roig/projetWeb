angular.module('Decibels').controller('newsController', ['$http','currentTab', function($http,currentTab) {
    var self = this;
    currentTab.setCurrentTab(3);
    self.title = "Toutes les actualités";

    $http({
        method: 'GET',
        url: '/back/Routeur.php',
        params: {
                'controller': 'News',
                'method': 'getAllNewsSorted'
        }
    })
    .then(function success(response){
        self.listNews = response.data;
    }
    , function error(response) {
        console.log('Error getting all news : ' + response);
    });
}]);
