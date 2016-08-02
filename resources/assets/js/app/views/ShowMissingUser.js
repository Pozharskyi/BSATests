var Marionette = require('backbone.marionette');

var ShowMissingUser = Marionette.ItemView.extend({
    template: '#missing-user-template'
});
module.exports = ShowMissingUser;