var UsersModel = require('./UsersModel');

var API = {

    getUserEntities: function () {
        var users = new EntitiesUsersCollection();
        users.fetch();
        return users;
    },

};
module.exports = API;