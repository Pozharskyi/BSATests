# BSA homework CRUD library on marionette js Works with REST API

##Deployment:

 - create BD and add properties to .env

 - artisan migrate

 - artisan DB:seed

 - npm install

 - bower install

 - grunt dev (or grunt prod / grunt stage)


Application consists of:
Books - shows the list of existing books.
All users - shows the list of existing users.
Create book - shows users creation form (all fields validate with specified rules).

In books section we could choose such actions as:
1)Edit - shows books editing form (all fields validate with specified rules).
2)Show - shows info about chosen book.
3)Delete - delete chosen book.

In All users section we could choose such actions as:
1)Show - shows info about chosen user.
2)My books - shows the list of books that were assigned to this user.
3)Assign books - shows the list of all books with available action - Assign, that assigns chosen book to current user.

All actions are also available by specific routes.