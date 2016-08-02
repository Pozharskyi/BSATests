var $ = require('jquery');
var _ = require('underscore');

var Backbone = require('backbone');
Backbone.$ = $;
Backbone._ = _;

var Library = require('./app');
require('./routes/BooksAppRouter.js');
require('./routes/UsersAppRouter.js');

Library.start();