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

    // Homepage, lists all stylists
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

    //Stylist pages, lists clients, allows edit and deletion
    $app->get("/stylist/{id}", function($id) use ($app) {
        $stylist = Stylist::find($id);

        return $app['twig']->render('stylist.html.twig', array(
            'stylist' => $stylist
        ));
    });

    $app->get("/stylist/{id}/edit", function($id) use ($app) {
        $stylist = Stylist::find($id);

        return $app['twig']->render('stylist_edit.html.twig', array(
            'stylist' => $stylist
        ));
    });

    $app->get("/stylist/{id}/delete", function($id) use ($app) {
      $stylist = Stylist::find($id);

      return $app['twig']->render('stylist_delete.html.twig', array(
        'stylist' => $stylist
      ));
    });

    $app->patch("/stylist/{id}", function($id) use ($app) {
        $stylist = Stylist::find($id);
        $stylist->update($_POST['new-name']);

        return $app['twig']->render('stylist.html.twig', array(
            'stylist' => $stylist,
            'message' => array(
                'type' => 'info',
                'text' => 'The name of your stylist was updated to ' . $stylist->getName()
            )
        ));
    });

    $app->delete("/stylist/{id}", function($id) use ($app) {
        $stylist = Stylist::find($id);
        $stylist->delete();

        return $app['twig']->render('index.html.twig', array(
            'stylists' => Stylist::getAll(),
            'message' => array(
                'type' => 'danger',
                'text' => $stylist->getName() . " was deleted."
            )
        ));
    });

    $app->post("/stylist/{id}/addClient", function($id) use ($app) {
        $stylist = Stylist::find($id);
        $new_client = new Client($_POST['client-name'], $id);
        $new_client->save();

        return $app['twig']->render('stylist.html.twig', array(
            'stylist' => $stylist,
            'message' => array(
                'type' => 'info',
                'text' => $new_client->getName() . " was added to " . $stylist->getName() . "'s client list"
            )
        ));
    });


    return $app;
?>
