var Library = require('./../app');
var ShowUsersBooksView = require('../views/ShowUsersBooksView');
var ShowBookView = require('../views/ShowBookView');
var ShowMissingBook = require('../views/ShowMissingBookView');


var ShowUsersBooksController = {
    showUsersBooks: function (id) {
        console.log('in showUserBooks controller');
        var view;

        var fetchingUsersBook = Library.request('usersBook:entities', id);
        $.when(fetchingUsersBook).done(function (usersBooks) {
            if (usersBooks !== undefined) {
                console.log(usersBooks);

                view = new ShowUsersBooksView({
                    collection: usersBooks
                });
            }
            else {
                view = new ShowMissingBook();
            }

            Library.mainRegion.show(view);
        });

        view.on('childview:usersBook:delete', function (childview, model) {
            console.log('destroying model');
            model.destroy();
            alert('book has been refunded successfully');
        });

    }
};
module.exports = ShowUsersBooksController;