var Library = require('./../app');
var AssignBooksView = require('../views/AssignBooksView');


var AssignBooksController = {
    assignBook: function (userId) {
        console.log('in assignBook controller');

        var books = Library.request('freeBook:entities');
        var view = new AssignBooksView({
            collection: books
        });
        view.on('childview:usersBook:assignClicked', function (childview, model) {
            Library.request('usersBook:assign', userId, model.get('id'));
            Library.trigger('users:list');
            alert('book has benn assigned successfully');
        });

        Library.mainRegion.show(view);
    }
};
module.exports = AssignBooksController;