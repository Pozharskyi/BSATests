var $ = require('jquery');

var EntitiesUsersBook = require('./UserBookModel');
var API = {
    getUsersBookEntity: function (userId, bookId) {
        var book = new EntitiesUsersBook({id: bookId}, {group: userId});
        var defer = $.Deferred();

        book.fetch({
            success: function (data) {
                defer.resolve(data);
            },
            error: function (data) {
                defer.resolve(undefined);
            }
        });
        return defer.promise();
    },
};
module.exports = API;