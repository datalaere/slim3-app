

// Config DB

if( !empty($_ENV['DB_DRIVER']) ) {

    $settings = $container->get('settings')['connections'][$_ENV['DB_DRIVER']];

    $capsule = new Illuminate\Database\Capsule\Manager;
    $capsule->addConnection($settings);
    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    $container['db'] = function ($c) use ($capsule) {
        return $capsule;
    };

}


// Config validation
use Respect\Validation\Validator as v;

$container['validator'] = function ($c) {
    return new App\Validation\Validator;
};

v::with('App\\Validation\\Rules\\');



// Config logging
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};


// Config Auth
$container['auth'] = function ($c) {
    return new App\Services\Auth;
};


// Config CSRF
$container['csrf'] = function ($c) {
    $guard = new \Slim\Csrf\Guard();
    $guard->setFailureCallable(function ($req, $res, $next) {
        $req = $req->withAttribute("csrf_status", false);
        return $next($req, $res);
    });
    return $guard;
};


// Config flash messages
$container['flash'] = function ($c) {
    return new Slim\Flash\Messages();
};


// Application middleware

$app->add(new App\Http\Middleware\ValidationErrorsMiddleware($container));

$app->add(new App\Http\Middleware\PersistingInputMiddleware($container));

$app->add($container->csrf);



// Controller configuration

$container['HomeController'] = function ($c) {
    return new App\Http\Controllers\HomeController($c);
};

$container['AuthController'] = function ($c) {
    return new App\Http\Controllers\Auth\AuthController($c);
};


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the Router within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\GuestMiddleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the Router within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$app->get('/', 'HomeController:index')->setName('home');


$app->group('', function() {
// Register
    $this->get('/auth/register', 'AuthController:getRegister')->setName('auth.register');

    $this->post('/auth/register', 'AuthController:postRegister');

// Login
    $this->get('/auth/login', 'AuthController:getLogin')->setName('auth.login');

    $this->post('/auth/login', 'AuthController:postLogin');
})->add(new GuestMiddleware($container));



$app->group('', function() {

    // Password change
    $this->get('/auth/password/change', 'AuthController:getChangePassword')->setName('auth.password.change');

    $this->post('/auth/password/change', 'AuthController:postChangePassword');

    // Logout
    $this->get('/auth/logout', 'AuthController:getLogout')->setName('auth.logout');
})->add(new AuthMiddleware($container));


$app->get('/test', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info('INFO', $args);

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
})->setName('test');


