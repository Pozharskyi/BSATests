
var Marionette = require('backbone.marionette');
var app = require('./../app');

    var ListBook = Marionette.ItemView.extend({
        template: '#books-list-template',
        tagName: 'tr',
        ui: {
            'delete': 'button.js-delete',
            'show': 'td a.js-show',
            'edit': 'td a.js-edit'
        },

        events: {
            'click @ui.delete': 'deleteClicked',
            'click @ui.show': 'showClicked',
            'click @ui.edit': 'editClicked',

        },
        editClicked: function (e) {
            e.preventDefault();
            this.trigger('book:edit', this.model);
        },
        showClicked: function (e) {
            e.preventDefault();
            this.trigger('book:show', this.model);
        },

        deleteClicked: function () {
            //this.model.collection.remove(this.model);
            this.trigger('book:delete', this.model);
        },

        //add animation fadeout when itemView is deleting
        remove: function () {
            var self = this;
            this.$el.fadeOut(function () {
                Marionette.ItemView.prototype.remove.call(self);
            });
        }
    });
    var ListBooks = Marionette.CompositeView.extend({
        tagName: 'table',
        className: 'table table-bordered',
        childView: ListBook,
        template: '#books-list',
        childViewContainer: 'tbody'
    });
module.exports = ListBooks;