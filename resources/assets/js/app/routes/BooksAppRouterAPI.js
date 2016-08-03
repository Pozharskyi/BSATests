var ListBooksController = require('../controllers/ListBooksController');
var ShowBookController = require('../controllers/ShowBookController');
var EditBookController = require('../controllers/EditBookController');
var CreateBookController = require('../controllers/CreateBookController');

var BooksModel = require('../models/BooksModel');
var API = {
    listBooks: function () {
        console.log('in RouterAPI listBooks');
        ListBooksController.listBooks();
    },
    showBook: function (id) {
        console.log('in RouterAPI showBook');

        ShowBookController.showBook(id);
    },
    editBook: function (id) {
        console.log('in RouterAPI editBook');

        EditBookController.editBook(id);
    },
    createBook: function () {
        console.log('in RouterAPI createBook');

        CreateBookController.createBook();
    },

};
module.exports = API;