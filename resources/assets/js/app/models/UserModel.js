var $ = require('jquery');
var _ = require('underscore');

var Backbone = require('backbone');


var Library = require('./../app');

var EntitiesUser = Backbone.Model.extend({
    urlRoot: 'http://localhost:8000/api/v1/users',
    parse: function (response, options) {
        if (options.collection) {
            return response;
        }
        return response.data;
    },
});

var API = {
    getUserEntity: function (userId) {
        console.log('in getUserEntity');

        var user = new EntitiesUser({id: userId});
        var defer = $.Deferred();

        user.fetch({
            success: function (data) {
                defer.resolve(data);
            },
            error: function (data) {
                defer.resolve(undefined);
            }
        });
        return defer.promise();
    },

};

Library.reqres.setHandler('user:entity', function (id) {
    return API.getUserEntity(id);
});
module.exports = EntitiesUser;