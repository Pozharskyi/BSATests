//Library.module('BooksApp.Show', function(Show, Librery, Backbone, Marionette, $, _){
var Marionette = require('backbone.marionette');
var app = require('./../app');

    var ShowBook = Marionette.ItemView.extend({
        template: '#book-view',
        tagName: 'ul',
        className: 'list-group'
        //serializeData : function() {
        //    var book = this.model.get('data');
        //    return {
        //        title : book.title,
        //        author : book.author,
        //        genre :book.genre,
        //        year: book.year,
        //    };
        //}
    });

module.exports = ShowBook;