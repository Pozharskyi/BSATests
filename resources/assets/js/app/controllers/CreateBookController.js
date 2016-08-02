//Library.module('BooksApp.Create', function (Create, Library, Backbone, Marionette, $, _) {
var Library = require('./../app');
var BookModel = require('../models/BookModel');
var CreateBookView = require('../views/CreateBookView');


var BooksAppCreateController = {
    createBook: function () {

        var view = new CreateBookView();
        Library.mainRegion.show(view);

        //save book from the form create, after submitClicked, and then return to books list
        view.on('form:submit', function (data) {

            var book = new BookModel(data);

            if (book.save()) {
                Library.trigger('books:list');
                alert('book has been created successfully');
            } else {
                view.triggerMethod('form:data:invalid', book.validationError);
            }
        });

    }
};
module.exports = BooksAppCreateController;




