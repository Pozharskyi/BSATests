
var Backbone = require('backbone');

var Library = require('./../app');
var UserModel = require('../models/UserModel');


var EntitiesUsersCollection = Backbone.Collection.extend({
    url: 'http://localhost:8000/api/v1/users',
    model: UserModel,
    parse: function (response) {
        return response.data;
    },

    comparator: function (user) {
        return user.get('id');
    }
});

var API = {

    getUserEntities: function () {
        console.log('in getUserEntities');

        var users = new EntitiesUsersCollection();
        users.fetch();
        return users;
    },

};


Library.reqres.setHandler('user:entities', function () {
    return API.getUserEntities();
});
module.exports = EntitiesUsersCollection;