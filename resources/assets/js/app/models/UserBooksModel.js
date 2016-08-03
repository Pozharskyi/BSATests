var $ = require('jquery');

var Backbone = require('backbone');


var Library = require('./../app');
var UserBookModel = require('../models/UserBookModel');

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
var API = {
    getUsersBookEntities: function (usersId) {
        var books = new EntitiesUsersBooks([], {group: usersId});
        console.log(books);
        books.fetch();
        return books;
    },

    assignBookToUser: function(userId, bookId){
        $.ajax({
            url: 'http://localhost:8000/api/v1/users/'+userId+'/books/'+bookId,
            type: 'PUT',
            success: function(data) {
                console.log('book assigned successfully');
                console.log(data);
            }
        });
    }
};
Library.reqres.setHandler('usersBook:entities', function (userId) {
    return API.getUsersBookEntities(userId);
});

Library.reqres.setHandler('usersBook:assign', function (userId, bookId) {
    return API.assignBookToUser(userId, bookId);
});
module.exports = EntitiesUsersBooks;