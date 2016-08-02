var ListBooksController = require('../controllers/ListBooksController');
var ShowBookController = require('../controllers/ShowBookController');
var EditBookController = require('../controllers/EditBookController');
var CreateBookController = require('../controllers/CreateBookController');

var API = {
    listBooks: function () {
        ListBooksController.listBooks();
    },
    showBook: function (id) {
        ShowBookController.showBook(id);
    },
    editBook: function (id) {
        EditBookController.editBook(id);
    },
    createBook: function () {
        CreateBookController.createBook();
    },

};
module.exports = API;