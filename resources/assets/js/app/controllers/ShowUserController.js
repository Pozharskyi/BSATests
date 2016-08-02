var Library = require('./../app');
var ShowUserView = require('../views/ShowUserView');
var ShowMissingUser = require('../views/ShowMissingUser');

    var ShowController = {
        showUser: function (id) {
            console.log('in showUser controller');
            var userView;
            var fetchingUser = Library.request('user:entity', id);
            $.when(fetchingUser).done(function(user){
                if(user !== undefined){
                    userView = new ShowUserView({
                        model: user
                    });
                } else {
                    userView = new ShowMissingUser();
                }

                Library.mainRegion.show(userView);
            });

        }
    }
module.exports = ShowController;