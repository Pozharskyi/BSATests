{{--<!DOCTYPE html>--}}
{{--<html>--}}
{{--<head>--}}
    {{--<title>Laravel</title>--}}

    {{--<link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">--}}

{{--</head>--}}
{{--<body>--}}
{{--<div class="container">--}}
    {{--<div class="content">--}}
        {{--<div class="title">Laravel 5</div>--}}
    {{--</div>--}}
{{--</div>--}}
{{--</body>--}}
{{--</html>--}}
        <!DOCTYPE html>
<html lang="en">
<head>
    <link href="css/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
    <!--<link href="css/bootstrap/dist/css/bootstrap-theme.css" rel="stylesheet">-->
    <meta charset="UTF-8">
    <title>Library</title>
</head>
<body>
<nav class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="#books">Books</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="#"><a href="#createbook" class="js-create">Create book</a></li>
            <li><a href="#users" class="js-list-users">All users</a></li>

        </ul>
    </div>
</nav>

<div id="main-region" class="container">
</div>
<!--book show template-->
<script type="text/template" id="book-view">
    <li class="list-group-item">Title: <%=title %></li>
    <li class="list-group-item">Author: <%=author %></li>
    <li class="list-group-item">Genre: <%=genre %></li>
    <li class="list-group-item">Year: <%=year %></li>
    <li class="list-group-item">Assigned to user: <%=userId %></li>
</script>

<!--all books compositeView template-->
<script type="text/template" id="books-list">

    <thead>
    <th colspan="100%">AllBooks</th>
    <tr>
        <th>Title</th>
        <th>Author</th>
        <th>Genre</th>
        <th>Year</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody></tbody>
</script>

<!--book list template view-->
<script type="text/template" id="books-list-template">
    <td><%=title %></td>
    <td><%=author %></td>
    <td><%=genre %></td>
    <td><%=year %></td>
    <td>
        <a href="#books/<%= id%>/edit" class="btn btn-warning btn-sm js-edit">Edit</span></a>
        <a href="#contacts/<%= id %>" class="btn btn-sm btn-success js-show">Show</a>
        <button class="btn btn-danger btn-sm js-delete">Delete</button>
    </td>
</script>

<!--view template for not found book-->
<script type="text/template" id="missing-book-template">
    <div class="alert alert-danger">This book does not exist in our library!</div>
</script>

<!--update book template view-->
<script type="text/template" id="book-update-template">
    <h1>Edit book#<%=id %></h1>
    <form>
        <div class="form-group">
            <lable for="book-title">Title:</lable>
            <input type="text" class="form-control book-title-edit" name="title" value="<%=title %>">
        </div>
        <div class="form-group">
            <lable for="book-author">Author:</lable>
            <input type="text" class="form-control book-author-edit" name="author" value="<%=author %>">
        </div>
        <div class="form-group">
            <lable for="book-genre">Genre:</lable>
            <input type="text" class="form-control book-genre-edit" name="genre" value="<%=genre %>">
        </div>
        <div class="form-group">
            <lable for="book-year">Year:</lable>
            <input type="number" class="form-control book-year-edit" name="year" value="<%=year %>">
        </div>
        <button class="btn btn-default js-submit">Edit submit</button>
    </form>
</script>

<!--crate book template view-->
<script type="text/template" id="book-create-template">
    <h1>Create new book</h1>
    <form>
        <div class="form-group">
            <lable for="book-title">Title:</lable>
            <input type="text" class="form-control book-title-create">
        </div>
        <div class="form-group">
            <lable for="book-author">Author:</lable>
            <input type="text" class="form-control book-author-create">
        </div>
        <div class="form-group">
            <lable for="book-genre">Genre:</lable>
            <input type="text" class="form-control book-genre-create">
        </div>
        <div class="form-group">
            <lable for="book-year">Year:</lable>
            <input type="number" class="form-control book-year-create">
        </div>
        <button class="btn btn-default js-submit-create">Create</button>
    </form>
</script>


<!--user show template-->
<script type="text/template" id="user-view">
    <li class="list-group-item">First name: <%=firstName %></li>
    <li class="list-group-item">Last Name: <%=lastName %></li>
    <li class="list-group-item">Email: <%=email %></li>
</script>

<!--view template for not found user-->
<script type="text/template" id="missing-user-template">
    <div class="alert alert-danger">Current user does not exist!</div>
</script>


<!--users books list template view-->
<script type="text/template" id="usersbooks-list-template">
    <td><%=title %></td>
    <td><%=author %></td>
    <td><%=genre %></td>
    <td><%=year %></td>
    <td>
        <button class="btn btn-danger btn-sm js-delete">Refund book</button>
    </td>
    <!--<td>-->
    <!--<a href="#books/<%= id%>/edit" class="btn btn-warning btn-sm js-edit">Edit</span></a>-->
    <!--<a href="#contacts/<%= id %>" class="btn btn-sm btn-success js-show">Show</a>-->

    <!--</td>-->
</script>

<!--users books composite template view-->
<script type="text/template" id="usersbooks-list">

    <thead>
    <th colspan="100%">Assigned books</th>
    <tr>
        <th>Title</th>
        <th>Author</th>
        <th>Genre</th>
        <th>Year</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody></tbody>
</script>
<!--books list for user assigning composite view-->
<script type="text/template" id="books-list-toassign">

    <thead>
    <th colspan="100%">AllBooks</th>
    <tr>
        <th>Title</th>
        <th>Author</th>
        <th>Genre</th>
        <th>Year</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody></tbody>
</script>

<!--books list for user assigning item view-->
<script type="text/template" id="books-list-toassign-template">
    <td><%=title %></td>
    <td><%=author %></td>
    <td><%=genre %></td>
    <td><%=year %></td>
    <td>
        <button class="btn btn-success btn-sm js-assign">Assign book</button>
    </td>
</script>

<!--users list item view-->
<script type="text/template" id="users-list-template">
    <td><%=firstName %></td>
    <td><%=lastName %></td>
    <td><%=email %></td>
    <td>
        <a href="#users/<%= id%>" class="btn btn-success btn-sm js-show">Show</span></a>
        <a href="#users/<%= id%>/books" class="btn btn-primary btn-sm js-show-assigned-books">My books</a>
        <a href="#users/<%= id%>/assign" class="btn btn-primary btn-sm js-assign-list">Assign books</a>
    </td>

    <!--<td><button class="btn btn-success btn-sm js-assign">Assign book</button></td>-->
</script>
<!--users list composite view-->
<script type="text/template" id="users-list">

    <thead>
    <th colspan="100%">All Users</th>
    <tr>
        <th>First name</th>
        <th>Last name</th>
        <th>Email</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody></tbody>
</script>

<script src="js/vendor/jquery.js"></script>
<script src="js/vendor/json2.js"></script>
<script src="js/vendor/underscore.js"></script>
<script src="js/vendor/backbone.js"></script>


<script src="js/vendor/backbone.wreqr.js"></script>
<script src="js/vendor/backbone.marionette.js"></script>

<script src="js/app.js"></script>
<script src="js/entities/book.js"></script>
<script src="js/entities/user.js"></script>

<script src="js/apps/books/books_app.js"></script>
<script src="js/apps/users/users_app.js"></script>

<script src="js/apps/books/list/list_view.js"></script>
<script src="js/apps/books/list/list_controller.js"></script>

<script src="js/apps/books/show/show_view.js"></script>
<script src="js/apps/books/show/show_controller.js"></script>

<script src="js/apps/books/edit/edit_view.js"></script>
<script src="js/apps/books/edit/edit_controller.js"></script>

<script src="js/apps/books/create/create_view.js"></script>
<script src="js/apps/books/create/create_controller.js"></script>

<!--users section-->
<script src="js/entities/usersBook.js"></script>
<script src="js/apps/users/showBooks/showBooks_view.js"></script>
<script src="js/apps/users/showBooks/showBooks_controller.js"></script>

<script src="js/apps/users/show/show_view.js"></script>
<script src="js/apps/users/show/show_controller.js"></script>

<script src="js/apps/users/assignBook/assignBook_view.js"></script>
<script src="js/apps/users/assignBook/assignBook_controller.js"></script>

<script src="js/apps/users/list/list_view.js"></script>
<script src="js/apps/users/list/list_controller.js"></script>


<script type="text/javascript">

    Library.start();
</script>
</body>
</html>