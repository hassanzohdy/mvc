# mvc
## class Route 
      
    Route class responsible for routing for the app, and controll the request 
    it has methods:
       public methods
            add(string: type, string: route , string: contrller) : add the specific route to  array of allowed routes
            load() run the app by accept the request url and check for the right route
        
        private methods 
            Match():match the current url request with allowed routes if matched call map() function with this route as param
                     if not match any route call a notFound() function
            map(array route): calling two function getClass and then callFunction;
            getClass(string action): get the controller class
            callFunction(string classname): calling this function
            