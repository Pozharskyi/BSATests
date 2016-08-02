var UserModel = require('./UserModel');

var API = {
    getUserEntity: function (userId) {
        var user = new UserModel({id: userId});
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
module.exports = API;