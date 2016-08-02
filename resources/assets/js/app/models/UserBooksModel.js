var Library = require('./../app');
var UserBookModel = require('../models/UserBookModel');
var API = require('./UserBooksModelAPI');

var EntitiesUsersBooks = Backbone.Collection.extend({
    url: function () {
        return 'http://localhost:8000/api/v1/users/' + this.options.group + '/books';
    },
    initialize: function (models, options) {
        this.options = options;
    },
    parse: function (response, options) {
        return response.data;
    },
    model: UserBookModel
});


Library.reqres.setHandler('usersBook:entities', function (userId) {
    return API.getUsersBookEntities(userId);
});

Library.reqres.setHandler('usersBook:assign', function (userId, bookId) {
    return API.assignBookToUser(userId, bookId);
});
module.exports = EntitiesUsersBooks;