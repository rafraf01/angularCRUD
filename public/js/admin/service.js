/**
 * Created by rafael.delacruz on 2/21/18.
 */
app.factory('dataFactory', function($http) {
    return {
        get : function(pageNumber) {
            return  $http.get('/task?page=' + pageNumber)
        },
        create : function(config) {
            return $http.post('/task/create',config)
        },
        update : function(index,config) {
            return $http.post('/task/update/'+ index,config)
        },
        destroy : function(id){
            return  $http.post('/task/delete/'+ id)
        }
    }
});
