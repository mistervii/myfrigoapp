<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

//GET HELP
$app->get('/api/help', function(Request $request, Response $response){
   
   
 echo " nl2br GET: /api/recipes => toutes les recettes\r\n ";
 echo " GET: /api/recipe/{id_recette} => recette avec id\r\n ";
 echo " GET: /api/recipe/ingrd/{id_recette} => ingredients d une recette\r\n ";
 echo " GET: /api/recipe/steps/{id_recette} => etapes d une recette\r\n ";
 echo " GET: /api/frigo_recipes/{id_user} => listes recette suggere\r\n ";
 echo " PUT: /api/frigo/update/{id_user} => mise a jour du frigo d un user ps: ajouter les parametres id_ingrd , quantite , id_unite\n";
   
   
   
	    
   
});

// Get All recipes
$app->get('/api/recipes', function(Request $request, Response $response){
    $sql = "SELECT * FROM recette_info";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $recettes = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
	    
  echo json_encode($recettes);
	    
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Get Single recipe
$app->get('/api/recipe/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');

    $sql = "SELECT * FROM recette_info WHERE id_recette = $id";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $recette = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($recette);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});
// Get ingredient  recipe
$app->get('/api/recipe/ingrd/{id_recette}', function(Request $request, Response $response){
    $id_recette = $request->getAttribute('id_recette');

    $sql = "SELECT * FROM recette_ingrd WHERE id_recette = $id_recette";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $ingrd = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($ingrd);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});
// Get Single recipe
$app->get('/api/recipe/steps/{id_recette}', function(Request $request, Response $response){
    $id_recette = $request->getAttribute('id_recette');

    $sql = "SELECT * FROM recette_step WHERE id_recette = $id_recette";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $steps = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($steps);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Get sugested recipes
$app->get('/api/frigo_recipes/{id_user}', function(Request $request, Response $response){
    $id_user = $request->getAttribute('id_user');

    $sql = "
		select id_recette_originale from
		(SELECT recette_info.id_recette as id_recette_frigo,count(*) as qte_frigo from recette_info , recette_ingrd , frigo 
		where recette_ingrd.id_recette=recette_info.id_recette 
		and recette_ingrd.id_ingrd = frigo.id_ingrd 
		and frigo.id_user = $id_user
		and frigo.quantite >= recette_ingrd.quantite
		group by recette_info.id_recette) as table1,
		(select recette_ingrd.id_recette as id_recette_originale,count(recette_ingrd.id_ingrd) as qte_recette_originale from recette_ingrd group by recette_ingrd.id_recette) as table2
		where id_recette_originale=id_recette_frigo
		and (qte_frigo/qte_recette_originale)*100>=65";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $recettes = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($recettes);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});


// Update Frigo
$app->put('/api/frigo/update/{id_user}', function(Request $request, Response $response){
	
    $id_user = $request->getAttribute('id_user');
    $id_ingrd = $request->getParam('id_ingrd');
    $quantite = $request->getParam('quantite');
    $id_unite = $request->getParam('id_unite');
	
   

    $sql = "UPDATE frigo SET
				id_unite 	= :id_unite,
				quantite 	= :quantite
               
			WHERE id_ingrd = $id_ingrd and id_user = $id_user" ;

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':id_unite', $id_unite);
        $stmt->bindParam(':quantite',  $quantite);
       

        $stmt->execute();

        echo '{"notice": {"text": "Frigo Updated"}';

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});


