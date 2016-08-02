var Marionette = require('backbone.marionette');
var app = require('./../app');

    var AssignBookView = Marionette.ItemView.extend({
        template: '#books-list-toassign-template',
        tagName: 'tr',
        ui:{
            'assign':'button.js-assign'
        },
        events: {
            'click @ui.assign': 'assignClicked',

        },
        assignClicked: function () {
            this.trigger('usersBook:assignClicked', this.model);
        },

    });
    var AssignBooksView = Marionette.CompositeView.extend({
        tagName: 'table',
        className: 'table table-bordered',
        childView: AssignBookView,
        template: '#books-list-toassign',
        childViewContainer: 'tbody'
    });
module.exports = AssignBooksView;