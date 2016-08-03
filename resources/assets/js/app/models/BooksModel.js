var Backbone = require('backbone');

var Library = require('./../app');
var BookModel = require('../models/BookModel');


var BooksCollection = Backbone.Collection.extend({
    url: 'http://localhost:8000/api/v1/books',
    model: BookModel,
    parse: function (response) {
        return response.data;
    },

    comparator: function (book) {
        return book.get('id');
    }
});

var API = {
    getBookEntities: function () {
        console.log('in getBookEntities');

        var books = new BooksCollection();
        books.fetch();
        return books;
    },


    getFreeBookEntities: function () {
        console.log('in getFreeBookEntities');

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

Library.reqres.setHandler('book:entities', function () {
    return API.getBookEntities();
});


Library.reqres.setHandler('freeBook:entities', function () {
    return API.getFreeBookEntities();
});
module.exports = BooksCollection;