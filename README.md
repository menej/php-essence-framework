# php-template-v2

This is a simple and intuitive PHP MVC framework that can be used for small or medium-sized projects.

## Initial Document Folder Tree

- config
    - sql
        - db.sql
    - config.php
- controller
    - IndexController.php
- core
    - functions.php
    - Response.php
    - Session.php
    - Validator.php
    - ViewHelper.php
- model
    - DBInit.php
- view
    - partials
        - head.php
        - footer.php
    - index.view.php
    - 400.php
    - 403.php
    - 404.php
- routes.php
- README.md

### public

This is the PHP server directory where we start our server. It is crucial to set the document root when booting up the
server. For example: `php -S localhost:8888 -t public`. This directory is also used to store CSS and JS files, hiding
other files from the public.

#### routes.php

This document serves as documentation for available routes and for use with a router in an MVC structure. It returns an
array containing all available routes.

Example of a valid route:

```php
<?php

return [
  "/" => [
      'GET' => ['IndexController', 'index']
  ]
];
```

Explanation:

- `/` - represents the URL route
- `GET` - represents the HTTP request type
- `['IndexController', 'index']` - the controller name is the first argument, and the second is the method inside the
  controller.

### index.php

This is the router of the project, routing different URL requests with their corresponding controllers and methods. The
router supports the four different HTTP requests. When submitting a form, an input with type hidden is added with a name
of "_method" and a value of the following (note: if the request is GET or POST, this does not need to be included).
However, when using any other types of methods, the form type should be POST.

RESTful approach is recommended, meaning the use of function names inside the controller:

```
index (example: show all notes) - GET
show (example: show details of a note) - GET
edit (example: show a form to edit a note) - GET
update (example: update a note) - POST/PATCH
create (example: show a form to create a note) - GET
store (example: store a note) - POST
delete (example: show a form to delete a note) - GET
destroy (example: delete a note) - POST/DELETE
```

If no corresponding method inside a controller is found, it shows a 404 error page. If a database error occurs, it shows
a 400 error page.

### config

Inside the sql directory, there is a db.sql file representing a physical database model. config.php holds the
configuration details of a database.

### core

This directory is used for utilities.

#### functions.php

In here, there are defined functions that can be used throughout the whole project. Some examples are `base_path($path)`
function, which we put in as an argument a path, and it returns us the whole path from the base. Another example is the
`controller($path)` function, which does a similar thing, but returns us the directory to the controller.

#### Response.php

This class is used for defining supported errors.

#### Session.php

This class is used to handle user sessions. Methods include:

```
put($key, $value)
get($key, $default = null)
has($key)
login($user)
logout()
```

#### Validator.php

This is where functions for validations and filters are defined. Consider an Authentication class to handle user
authentication.

#### ViewHelper.php

This class helps display a view to the user. Methods include:

```
render($file, $variables = [])
redirect($url)
abort($code = 404, $message ="")
```

### controller

This directory stores controllers. An example, `IndexController.php`, demonstrates how the logic works.

```php
<?php

namespace controller;

require base_path('core/ViewHelper.php');
require_once base_path("model/DBInit.php");

use core\ViewHelper;
use model\DBInit;

class IndexController
{
    public static function index(): void
    {

        DBInit::getInstance();

        $variables = ["title" => "Home"];
        ViewHelper::render('index.view.php', $variables);
    }
}
```

Note: For now, `DBInit::getInstance()` needs to be utilized at the beginning of each controller to initiate the database
instance. To address this in the future, consider implementing a singleton pattern.

### view

This directory stores views. Views should be named in a way that indicates it is a view - NAME.view.php. Semantically
corresponding views should fall into the same directory with the same name as their controller. The partials pattern is
used to inject the head and foot of the HTML document to decrease redundancy.

It's important to note that, due to this pattern, a title should be included in a $variables array before rendering each
view.

For instance, consider the `index.view.php` file:"

```php
<?php require "partials/head.php" ?>

<main>
    <p>Hello. Welcome to the home page!</p>
</main>

<?php require "partials/footer.php" ?>
```

