<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Stylist.php";
    require_once __DIR__."/../src/Client.php";

    // create silex object with twig templating
    $app = new Silex\Application();
    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
    ));

    // setup server for database
    $server = 'mysql:host=localhost:8889;dbname=hair_salon';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    // allow patch and delete request to be handled by browser
    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig', array(
            'stylists' => Stylist::getAll(),
        ));
    });

    $app->post("/", function() use ($app) {
        $new_stylist = new Stylist($_POST['stylist-name']);
        $new_stylist->save();

        return $app['twig']->render('index.html.twig', array(
            'stylists' => Stylist::getAll(),
            'message' => array(
                'type' => 'info',
                'text' => $_POST['stylist-name'] . " was added to the list of stylists."
            )
        ));
    });

    $app->delete("/deleteAll", function() use ($app) {
        Stylist::deleteAll();

        return $app['twig']->render('index.html.twig', array(
            'stylists' => Stylist::getAll(),
            'message' => array(
                'type' => 'danger',
                'text' => 'All stylists and thier clients have been deleted.'
            )
        ));
    });

    return $app;
?>
