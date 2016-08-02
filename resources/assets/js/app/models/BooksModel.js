var Library = require('./../app');
var BookModel = require('../models/BookModel');
var BookModelAPI = require('./BookModelAPI');
//Library.module('Entities', function (Entities, Library, Backbone, Marionette, $, _) {


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



Library.reqres.setHandler('book:entities', function () {
    return BookModelAPI.getBookEntities();
});


Library.reqres.setHandler('freeBook:entities', function () {
    return BookModelAPI.getFreeBookEntities();
});
module.exports = BooksCollection;