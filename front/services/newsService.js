angular.module('Decibels')
.service('news', ['$http',
function($http){

    var service = {
        getAllNews: function(callback) {
            $http({
                method: 'GET',
                url: '/back/Routeur.php',
                params: {
                        'controller': 'News',
                        'method': 'getAllNewsSorted'
                }
            })
            .then(function success(response){
                callback(true,response);
            },function error(response) {
                callback(false,response);
            });
        },

        getLatestNews: function(limit,callback) {
            $http({
                method: 'GET',
                url: '/back/Routeur.php',
                params: {
                        'controller': 'News',
                        'method': 'getLatestNews',
                        'limit': limit
                }
            })
            .then(function success(response){
                callback(true,response);
            },function error(response) {
                callback(false,response);
            });
        },

        countNews: function(callback) {
            $http({
                method: 'GET',
                url: '/back/Routeur.php',
                params: {
                        'controller': 'News',
                        'method': 'countNews'
                }
            })
            .then(function success(response){
                callback(true,response);
            },function error(response) {
                callback(false,response);
            });
        },

        insertNews: function(news_title, news_text, callback) {
            $http({
                method: 'POST',
                url: '/back/Routeur.php',
                params: {
                        'controller': 'News',
                        'method': 'insertNews',
                        'news_title': news_title,
                        'news_text': news_text
                }
            })
            .then(function success(response){
                callback(true,response);
            },function error(response) {
                callback(false,response);
            });
        },

        getNews: function(news_id,callback) {
            $http({
                method: 'GET',
                url: '/back/Routeur.php',
                params: {
                        'controller': 'News',
                        'method': 'getNews',
                        'news_id': news_id
                }
            })
            .then(function success(response) {
                callback(true,response);
            },function error(response) {
                callback(false,response);
            });
        }
    }

    return service;
}]);
