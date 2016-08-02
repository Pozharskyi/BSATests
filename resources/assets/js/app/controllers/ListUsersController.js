var Library = require('./../app');
var ListUsersView = require('../views/ListUsersView');


    var ListController = {
        listUsers: function(){
            var users = Library.request('user:entities');

            var view = new ListUsersView({
                collection: users
            });
            view.on('childview:user:show',function(childview,model){

                Library.trigger('user:show', model.get('id'));
            });
            view.on('childview:user:showBooksClicked',function(childview,model){
                console.log('in UsersApp.List/Controller ');

                Library.trigger('user:showBooks', model.get('id'));
                console.log(model.get('id'));
            });
            view.on('childview:user:showAssignList',function(childview,model){
                console.log('in UsersApp.List.Controller show assign list ');

                Library.trigger('user:showAssignList', model.get('id'));
                //console.log(model.get('id'));
            });

            Library.mainRegion.show(view);
        }
    }
module.exports = ListController;

