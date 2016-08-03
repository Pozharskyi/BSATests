var $ = require('jquery');

var UserBooksModel = require('./UserBooksModel');
var API = {
    getUsersBookEntities: function (usersId) {
        var books = new UserBooksModel([], {group: usersId});
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
module.exports = API;