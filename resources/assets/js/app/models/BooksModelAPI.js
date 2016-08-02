var BooksCollection = require('./BooksModel');

var API = {
    getBookEntities: function () {
        var books = new BooksCollection();
        books.fetch();
        return books;
    },


    getFreeBookEntities: function () {
        var books = new BooksCollection();
        books.fetch();
        booksFree = books.filter(
            function (model) {
                console.log('filter1');
                return model.get('userId') !== null;
            });


        //console.log(_.where(books,{userId:'1'}));
        //return books;
        console.log(booksFree);
        return books;
    }
};
module.exports = API;