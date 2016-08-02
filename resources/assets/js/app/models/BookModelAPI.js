var EntitiesBook = require('./BookModel');
var API = {
    getBookEntity: function (bookId) {
        var book = new EntitiesBook({id: bookId});
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
    }
}
module.exports = API;