var Marionette = require('backbone.marionette');

    var ShowUser = Marionette.ItemView.extend({
        template: '#user-view',
        tagName: 'ul',
        className: 'list-group'
    });

module.exports = ShowUser;