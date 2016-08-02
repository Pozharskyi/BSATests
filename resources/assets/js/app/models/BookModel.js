var Library = require('./../app');
var BookModelAPI = require('./BookModelAPI');

    var EntitiesBook = Backbone.Model.extend({
        urlRoot: 'http://localhost:8000/api/v1/books',
        validate: function (attrs, options) {
            var errors = {};
            if (!attrs.title) {
                errors.title = 'can not be empty';
            }
            if ((!/^[a-zA-Z]*$/g.test(attrs.title))) {
                errors.title = 'must contains oly letters'
            }
            if ((!/^[a-zA-Z]*$/g.test(attrs.author))) {
                errors.author = 'must contains oly letters'
            }

            if (!attrs.author) {
                errors.author = 'can not be empty'
            }
            if ((!/^[a-zA-Z]*$/g.test(attrs.genre))) {
                errors.genre = 'must contains oly letters'
            }
            if (!attrs.genre) {
                errors.genre = 'can not be empty'
            }
            if (/\D/.test(attrs.year)) {
                errors.year = 'must contains only digits'
            }
            if (!attrs.year) {
                errors.year = 'can not be empty'
            }
            if (!_.isEmpty(errors)) {
                return errors;
            }

        },
        parse: function (response, options) {
            if (options.collection) return response;
            return response.data;
        }

    });

    Library.reqres.setHandler('book:entity', function (id) {
        return BookModelAPI.getBookEntity(id);
    });
mdule.exports = EntitiesBook;