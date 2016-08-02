//Library.module('BooksApp.Create', function (Create, Library, Backbone, Marionette, $, _) {
var Marionette = require('backbone.marionette');
var app = require('./../app');
var BookModel = require('../models/BookModel');


var CreateBook = Marionette.ItemView.extend({
    template: '#book-create-template',
    events: {
        'click button.js-submit-create': 'submitClicked'
    },
    submitClicked: function (e) {
        e.preventDefault();
        var data = {
            'author': this.$('.book-author-create').val(),
            'title': this.$('.book-title-create').val(),
            'year': this.$('.book-year-create').val(),
            'genre': this.$('.book-genre-create').val(),
        };
        this.trigger('form:submit', data);
        console.log('create book submit ');
        console.log(data);
    },
    onFormDataInvalid: function (errors) {
        var $view = this.$el;
        console.log('on form data invalid method');

        var markErrors = function (value, key) {
            var $controlGroup = $view.find('.book-' + key + '-create').parent();
            var $errorEl = $('<span>', {class: 'help-inline error', text: value});
            $controlGroup.append($errorEl).addClass('error');
        };
        _.each(errors, markErrors);
    }
});
module.exports = CreateBook;