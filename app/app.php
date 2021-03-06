<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Client.php";
    require_once __DIR__."/../src/Stylist.php";

    $app = new Silex\Application();

    $server = 'mysql:host=localhost:8889;dbname=hair_salon';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });

    $app->get("stylists/{id}", function($id) use ($app) {
      $stylist = Stylist::find($id);
      return $app['twig']->render('stylist.html.twig', array('stylist' => $stylist, 'clients' => $stylist->getClients()));
    });

    $app->get("/stylists/{id}/edit", function($id) use ($app) {
      $stylist = Stylist::find($id);
      return $app['twig']->render('stylist_edit.html.twig', array('stylist' => $stylist));
    });

    $app->get("client/{id}/edit", function($id) use ($app) {
      $client = Client::find($id);
      return $app['twig']->render('client_edit.html.twig', array('client' => $client));
    });

    $app->patch("/stylists/{id}", function($id) use ($app) {
      $stylist_name = $_POST['stylist-name'];
      $stylist = Stylist::find($id);
      $stylist->update($stylist_name);
      return $app['twig']->render('stylist.html.twig', array('stylist' => $stylist, 'clients' => $stylist->getClients()));
    });

    $app->patch("/clients/{id}", function($id) use ($app) {
      $client_name = $_POST['client-name'];
      $client = Client::find($id);
      $client->update($client_name);
      return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });

    $app->delete("clients/{id}", function($id) use ($app) {
      $client = Client::find($id);
      $client->delete();
      return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });

    $app->post("/clients", function() use ($app) {
      $client_name = $_POST['client-name'];
      $stylist_id = $_POST['stylist_id'];
      $client = new Client($client_name, $stylist_id, $id = null);
      $client->save();
      $stylist = Stylist::find($stylist_id);
      return $app['twig']->render('stylist.html.twig', array('stylist' => $stylist, 'clients' => $stylist->getClients()));
    });

    $app->post("/stylists", function () use ($app) {
        $stylist = new Stylist($_POST['stylist-name']);
        $stylist->save();
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });

    $app->delete("/stylists/{id}", function($id) use ($app) {
        $stylist = Stylist::find($id);
        $stylist->delete();
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });

    return $app;
?>
