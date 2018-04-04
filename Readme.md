### Server Requirements
To run ScriptCha of your server, there is no special configuration however there something on the server level that needs to be taken care of in order for the framework to work flawlessly.

 - PHP 5.3 or greater
 - MySQL 5.6 or greater *OR* MariaDB 10.0 or greater
 - Nginx or Apache with mod_rewrite module

### Installation
Really it's very straight forward.

 - Clone or download git repo
 - Unzip and upload to your server
 - Make changes in config.php with your details
 - That's it

### Controller
All the controller classess will be saved in the director open ***pattern\controllers***. To create a controller class, create a php file and name it *WelcomeController.php* and save it in ***pattern\controllers***. Now open WelcomeController.php* and write the following class.

    <?php
	    class WelcomeController extends Controller{
		     
	    }


### Method
Within your ***WelcomeController.php*** class. We need to create a method called ***MyMethod***. Let's open ***WelcomeController.php*** and the following method.

    public function MyMethod(){
	 
    }
Your whole ***WelcomeController.php*** file should look something like this:

    <?php
	    class WelcomeController extends Controller{
	    
		    public function MyMethod(){
		    
		    }
		    
	    }

### Model
Model are used in a way to interact with the database making the application modular and re-usable code. All models are saved in the directory ***pattern\requests***. Create a file called ***Users.php*** and save it inside pattern\requests as ***Users.php***. To call the model in your controller use the following helper function.

    model( $model, $data );
**Example:**
To include the model into our ***WelcomeController.php*** on method we will do something like the following:

    <?php
    	class WelcomeController extends Controller{
	    	public function index(){
		    	$Users = model('Users');
	    	}
    	}

### Views
Views are stored in the ***pattern\views*** directory. Create a php file, let;s call it ***Welcome.php*** and save the file inside ***pattern\views***, To include the file in method, we can use the following helper function:

    view( $view, $data = array() );
**Example:**
To include the view into our ***WelcomeController.php*** on method ***MyMethod*** we will do something like the following:

    <?php
    	class WelcomeController extends Controller{
	    	public function index(){
				view('Welcome');
	    	}
    	}


### Routes
You can register GET or POST. Open *pattern/routes.php* and add the following line of code.

    Router::MyRequest('/MyURI', 'WelcomeController@MyMethod');

 - ***MyRequest*** is the HTTP Request. Can be ***get*** or ***post***
 - ***MyURI*** is the URI which you want to register
 - ***WelcomeController*** is the controller you want the bind the URI
 - ***MyMethod*** is the method in the controller ***WelcomeController***
 
### Helper Functions
Helper function helps to get work done with reusable or famous functions.
 - **sanitize_path( $path );**
Remove unwanted slashes and sanitizes the URI.

 -  ***site_uri();***
 Current page URI

 - ***site_path();***
Current website path defined in config.php

 - ***base_url();***
Current website URL defined in config.php

 - ***public_path();***
Defines the path of the public directory

 - ***public_url( $file = '' );***
Defines the URL of the public directory

 - ***controller_path();***
Defines the path of the controllers directory

 - ***model_path();***
Defines the path of the models directory

 - ***view_path();***
Defines the path of the views directory

 - ***app_path();***
Defines the path of the app directory

 - ***vendor_path();***
Defines the path of the vendor directory

 - ***view( $view, $data = array() );***
Helper function to inject the HTML into the view

 - ***model( $model, $data = array() );***
Helper function to inject the model into the controller

 - ***controller();***
Get the current controller that is in use

 - ***method();***
Get the current method that is in use

 - ***params();***
Get the params that was passed to the method

 - ***get_the_title();***
Get the title that was assigned by method to the controller static variable

 - ***current_permalink();***
Current URL that's displayed in the browser address bar

 - ***make_permalink( $path );***
Convert path to links so that it can be used in internal pages
