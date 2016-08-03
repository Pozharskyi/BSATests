
var $ = require('jquery');
var Library = require('./../app');
var ShowBookView = require('../views/ShowBookView');
var ShowMissingBook = require('../views/ShowMissingBookView');


var ShowController = {
    showBook: function (id) {

        var bookView;
        var fetchingBook = Library.request('book:entity', id);
        $.when(fetchingBook).done(function (book) {
            if (book !== undefined) {
                bookView = new ShowBookView({
                    model: book
                });
            } else {
                bookView = new ShowMissingBook();
            }

            Library.mainRegion.show(bookView);
        });

    }
}
module.exports = ShowController;