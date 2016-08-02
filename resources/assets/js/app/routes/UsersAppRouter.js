var Marionette = require('backbone.marionette');
var Library = require('./../app');
var API = require('./UsersAppRouterAPI');

UsersAppRouter = Marionette.AppRouter.extend({
    appRoutes: {
        'users': 'listUsers',
        'users/:id': 'showUser',
        'users/:id/books': 'showUsersBooks',
        'users/:userId/assign': 'showAssignList'
    }
});


Library.on('user:show', function (id) {
    console.log('in Library user showUser');
    Library.navigate('users/' + id);
    API.showUser(id);
});

Library.on('users:list', function () {
    Library.navigate('users');
    API.listUsers();
});

Library.on('user:showBooks', function (userId) {
    Library.navigate('users/' + userId + '/books');
    API.showUsersBooks(userId);
});

Library.on('user:showAssignList', function (userId) {
    Library.navigate('users/' + userId + '/assign');
    API.showAssignList(userId);
});


Library.on('before:start', function () {
    new UsersAppRouter({
        controller: API
    });
});

module.exports = UsersAppRouter;