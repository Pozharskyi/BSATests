var ListUsersController = require('../controllers/ListUsersController');
var ShowUserController = require('../controllers/ShowUserController');

var AssignBooksController = require('../controllers/AssignBooksController');
var ShowUsersBooksController = require('../controllers/ShowUsersBooksController');

var UserModel = require('../models/UserModel');
var UsersModel = require('../models/UsersModel');
var UserBooksModel = require('../models/UserBooksModel');
var UserBookModel = require('../models/UserBookModel');
API = {
    listUsers: function () {
        ListUsersController.listUsers();
    },
    showUser: function (id) {
        console.log('in API showUser');
        ShowUserController.showUser(id);
    },
    showUsersBooks: function (userId) {
        ShowUsersBooksController.showUsersBooks(userId);
    },
    showAssignList: function (userId, bookId) {
        AssignBooksController.assignBook(userId, bookId);
    },

};
module.exports = API;