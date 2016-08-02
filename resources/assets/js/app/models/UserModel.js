var Library = require('./../app');
var API = require('./UserModelAPI');

var EntitiesUser = Backbone.Model.extend({
    urlRoot: 'http://localhost:8000/api/v1/users',
    parse: function (response, options) {
        if (options.collection) {
            return response;
        }
        return response.data;
    },
});

Library.reqres.setHandler('user:entity', function (id) {
    return API.getUserEntity(id);
});
module.exports = EntitiesUser;