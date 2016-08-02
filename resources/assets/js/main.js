var $ = require('jquery');
var _ = require('underscore');

var Backbone = require('backbone');
Backbone.$ = $;
Backbone._ = _;
var Marionette = require('backbone.marionette');

var app = require('./app');
app.Library.start();