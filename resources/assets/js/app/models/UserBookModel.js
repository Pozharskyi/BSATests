var Library = require('./../app');
var API = require('./UserBookModelAPI');
var EntitiesUsersBook = Backbone.Model.extend({

    urlRoot: function () {
        console.log(this.options);
        if (this.options.collection === undefined) {
            return 'http://localhost:8000/api/v1/users/' + this.options.group + '/books';
        } else {
            return 'http://localhost:8000/api/v1/users/' + this.options.collection.options.group + '/books';
        }

    },
    initialize: function (models, options) {
        //console.log(options);
        this.options = options;
    },


    parse: function (response, options) {
        if (options.collection) return response;
        return response.data;
    }

});

Library.reqres.setHandler('usersBook:entity', function (userId, bookId) {
    return API.getUsersBookEntity(userId, bookId);
});
module.exports = EntitiesUsersBook;