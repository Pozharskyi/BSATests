var Library = require('./../app');
var ListBooksView = require('../views/ListBooksView');


    var ListController = {
        listBooks: function(){
            var books = Library.request('book:entities');

            var booksListView = new ListBooksView({
                collection: books
            });

            booksListView.on('childview:book:delete',function(childview,model){
               model.destroy();
            });
            booksListView.on('childview:book:show',function(childview,model){

                Library.trigger('book:show', model.get('id'));
            });
            booksListView.on('childview:book:edit',function(childview,model){

                Library.trigger('book:edit', model.get('id'));
            });

            Library.mainRegion.show(booksListView);
        }
    }
module.exports = ListController;
