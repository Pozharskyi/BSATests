
var $ = require('jquery');
var Library = require('./../app');
var BookModel = require('../models/BookModel');
var EditBookView = require('../views/EditBookView');
var ShowBookView = require('../views/ShowBookView');
var ShowMissingBook = require('../views/ShowMissingBookView');


var EditBookController = {
    editBook: function (id) {
        var view;
        var fetchingBook = Library.request('book:entity', id);
        $.when(fetchingBook).done(function (book) {
            if (book !== undefined) {
                view = new EditBookView({
                    model: book
                });
                //save book from the form edit, after submitClicked and return to bookShow route
                view.on('form:submit', function (data) {
                    console.log('in submit');
                    var valid = book.save(data, {
                        success: function (book, response) {
                            alert('book has been edited successfully');
                            Library.trigger('book:show', book.get('id'));

                        },
                    });
                    if (!valid) {
                        view.triggerMethod('form:data:invalid', book.validationError);
                    }

                });
            } else {
                view = new ShowMissingBook();
            }

            Library.mainRegion.show(view);
        });
    }
};

module.exports = EditBookController;