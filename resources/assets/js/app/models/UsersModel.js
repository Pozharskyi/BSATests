//Library.module('Entities', function (Entities, Library, Backbone, Marionette, $, _) {

var Library = require('./../app');
var UserModel = require('../models/UserModel');
var API = require('./UsersModelAPI');


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




    Library.reqres.setHandler('user:entities', function () {
        return API.getUserEntities();
    });
module.exports = EntitiesUsersCollection;