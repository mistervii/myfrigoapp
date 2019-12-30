<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();



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
           $response->setContent(json_encode($recettes));
       return $response;
	    
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Get Single recipe
$app->get('/api/recipe/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');

    $sql = "SELECT * FROM rcette_info WHERE id_recette = $id";

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


// Get sugested recipes
$app->get('/api/recipe/{id_user}', function(Request $request, Response $response){
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


