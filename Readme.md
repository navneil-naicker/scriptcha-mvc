**Server Requirements**

To run ScriptCha of your server, there is no special configuration however there something on the server level that needs to be taken care of in order for the framework to work flawlessly.

 - PHP 5.3 or greater
 - MySQL 5.6 or greater OR MariaDB 10.0 or greater
 - Nginx or Apache with mod_rewrite module

**Installation**

Really it's very straight forward.

 - Clone or download git repo
 - Unzip and upload to your server
 - Make changes in *config.php* with your details
 - That's it

**Controller**

All the controller classes will be saved in the director open pattern\controllers. To create a controller class, create a PHP file and name it  _WelcomeController.php_  and save it in pattern\controllers. Now open  _WelcomeController.php_  and write the following class.

    class WelcomeController extends Controller{ }

**Method**

Within your *WelcomeController.php* class. We need to create a method called *MyMethod*. Let's open *WelcomeController.php* and the following method.

    `public function MyMethod(){}`

**Model**

Model are used in a way to interact with the database making the application modular and re-usable code. All models are saved in the directory *pattern\requests*. Create a file called *Users.php* and save it inside pattern\requests as *Users.php*. To call the model in your controller use the following helper function.

`model( $model, $data );`

**Views**

Views are stored in the *pattern\views* directory. Create a PHP file, let;s call it *Welcome.php* and save the file inside pattern\views, To include the file in method, we can use the following helper function:

    view( $view, $data = array() );

**Routes**

You can register **GET** or **POST**. Open *pattern/routes.php* and add the following line of code.

    Router::MyRequest('/MyURI', 'WelcomeController@MyMethod');
