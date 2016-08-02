var ListUsersController = require('../controllers/ListUsersController');
var ShowUserController = require('../controllers/ShowUserController');

var AssignBooksController = require('../controllers/AssignBooksController');
var ShowUsersBooksController = require('../controllers/ShowUsersBooksController');
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