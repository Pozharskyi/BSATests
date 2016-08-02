var Marionette = require('backbone.marionette');

    var ShowBookView = Marionette.ItemView.extend({
        template: '#usersbooks-list-template',
        tagName: 'tr',
        ui:{
            'delete':'button.js-delete'
        },

        events: {
            'click @ui.delete': 'deleteClicked',
        },
        deleteClicked: function () {
            this.trigger('usersBook:delete', this.model);
        },
    });
    var ShowBooksView = Marionette.CompositeView.extend({
        tagName: 'table',
        className: 'table table-bordered',
        childView: ShowBookView,
        template: '#usersbooks-list',
        childViewContainer: 'tbody'
    });
module.exports = ShowBooksView;