angular.module('Decibels').controller('counterController',
['news','production', 'band',
function(news, production, band) {
    var self = this;
    self.count = {};

    // ==== LOAD data ==== //
    callbackNbBands = function(success,response) {
        if(success) self.count['nb_bands'] = response.data;
        else console.log('Error getting nb of bands : ' + response);;
    }
    band.countBands(callbackNbBands);

    callbackNbNews = function(success,response) {
        if(success) self.count['nb_news'] = response.data;
        else console.log('Error getting nb of news : ' + response);;
    }
    news.countNews(callbackNbNews);

    callbackNbProductions = function(success,response) {
        if(success) self.count['nb_prods'] = response.data;
        else console.log('Error getting nb of productions : ' + response);;
    }
    production.countProductions(callbackNbProductions);

}]);
