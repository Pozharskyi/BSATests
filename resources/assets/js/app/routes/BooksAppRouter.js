var Marionette = require('backbone.marionette');
var Library = require('./../app');
var API = require('./BooksAppRouterAPI');


var BooksAppRouter = Marionette.AppRouter.extend({
    appRoutes: {
        'books': 'listBooks',
        'books/:id': 'showBook',
        'books/:id/edit': 'editBook',
        'createbook': 'createBook',
    }
});

Library.on('books:list', function () {
    Library.navigate('books');
    API.listBooks();
});

Library.on('book:show', function (id) {
    Library.navigate('books/' + id);
    API.showBook(id);
});

Library.on('book:edit', function (id) {
    Library.navigate('books/' + id + '/edit');
    API.editBook(id);
});


Library.on('before:start', function () {
    new BooksAppRouter({
        controller: API
    });
})
module.exports = BooksAppRouter;