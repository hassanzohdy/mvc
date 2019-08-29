# mvc
## class Route 
      
    Route class responsible for routing the app, and controlls the request
    it stores the allowed routes and then cheaks for the right route which is matching the url and method type. 
    then load the controller function that is passed as argument to the class

    ```
    $router = new Core\Route();
    $route->add("get","/home", "HomeController@index");
    $route->add("get","/posts", "Postcontroller@index");
    $route->run();
    ```
    