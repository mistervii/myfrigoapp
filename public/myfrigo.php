<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

//GET HELP
$app->get('/api/help', function(Request $request, Response $response){
   
   
 echo nl2br(" GET: /api/recipes => toutes les recettes\r\n ;
 GET: /api/recipe/{id_recette} => recette avec id\r\n ;
 GET: /api/recipe/ingrd/{id_recette} => ingredients d une recette\r\n ;
 GET: /api/recipe/steps/{id_recette} => etapes d une recette\r\n ;
 GET: /api/frigo_recipes/{id_user} => listes recette suggere\r\n ;
 PUT: /api/frigo/update/{id_user} => mise a jour du frigo d un user ps: ajouter les parametres id_ingrd , quantite , id_unite\\r\n ;
 GET: /api/users => liste users\r\n ;
 GET: /api/user/{id} => l utilisateur avec id\r\n ;
 GET: /api/ingrd => liste ingrd\r\n ;
 GET: /api/ingrd/{id} => l ingrd avec id\r\n ;
 GET: /api/frigo/{id_user} => aliments dans frigot avec leur nom pour un user \r\n ;
 GET: /api/regimes =>liste des regimes\r\n ;
 GET: /api/regime/{id_regime} => regime de id \r\n ;
 GET: /api/articles => liste des articles \r\n ;
 GET: /api/toparticles => liste des top articles \r\n ;
 GET: /api/nomingrd =>  \r\n ;
 GET: /api/frigo/{id_user}/{id_ingrd}=> \r\n ;
 
 ");
   
   
   
	    
   
});
//GET ALL USERS
$app->get('/api/users', function(Request $request, Response $response){
   

    $sql = "SELECT * FROM user";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $users = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
     $response->getBody()->write( json_encode($users));
     return $response;
	   // echo json_encode($users);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});
//GET A USER
$app->get('/api/user/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');

    $sql = "SELECT * FROM user WHERE id_user = $id";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $user = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
	 
      $response->getBody()->write(json_encode($user));
	    return $response;
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});
//GET A ingrd
$app->get('/api/ingrd/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');

    $sql = "SELECT * FROM ingredients WHERE id_ingrd = $id";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $ingrd = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
	 
      $response->getBody()->write(json_encode($ingrd));
	    return $response;
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});
//GET list ingrd
$app->get('/api/ingrd', function(Request $request, Response $response){
    

    $sql = "SELECT * FROM ingredients ";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $ingrd = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
	 
      $response->getBody()->write(json_encode($ingrd));
	    return $response;
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});
//GET articles
$app->get('/api/articles', function(Request $request, Response $response){
    

    $sql = "SELECT * FROM articles";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $articles = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
	 
      $response->getBody()->write(json_encode($articles));
	    return $response;
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});
//GET TOP_articles
$app->get('/api/toparticles', function(Request $request, Response $response){
    

    $sql = "SELECT * FROM top_articles";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $articles = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
	 
      $response->getBody()->write(json_encode($articles));
	    return $response;
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
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
	    
	    $response->getBody()->write(json_encode($recettes));
	    return $response;
  //echo json_encode($recettes);
	    
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
        $recette = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
	    
	     $response->getBody()->write(json_encode($recette));
	    return $response;
	    
       // echo json_encode($recette);
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
        $ingrd = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
	    
	     $response->getBody()->write(json_encode($ingrd));
	    return $response;
	    
       // echo json_encode($ingrd);
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
        $steps = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
	    
	     $response->getBody()->write(json_encode($steps));
	    return $response;
	    
       // echo json_encode($steps);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});
//GET USER'S FRIGO
$app->get('/api/frigo/{id_user}', function(Request $request, Response $response){
    $id_user = $request->getAttribute('id_user');

    $sql = "SELECT ingredients.label_ingrd,frigo.* from frigo,ingredients where ingredients.id_ingrd=frigo.id_ingrd and frigo.id_user = $id_user";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $frigo = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
	    
	     $response->getBody()->write(json_encode($frigo));
	    return $response;
	    
       // echo json_encode($frigo);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});
//GET info ingrd user
$app->get('/api/frigo/{id_user}/{id_ingrd}', function(Request $request, Response $response){
    $id_user = $request->getAttribute('id_user');
	$id_ingrd = $request->getAttribute('id_ingrd');

    $sql = "SELECT * from frigo where id_ingrd=$id_ingrd and id_user = $id_user";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $frigo = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
	    
	     $response->getBody()->write(json_encode($frigo));
	    return $response;
	    
       // echo json_encode($frigo);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});
//GET info ingrd by nom
$app->get('/api/nomingrd/{nom}', function(Request $request, Response $response){
    $nom = $request->getAttribute('nom');

    $sql = "SELECT * FROM ingredients WHERE label_ingrd ='$nom'";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $ingrd = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
	 
      $response->getBody()->write(json_encode($ingrd));
	    return $response;
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
        $recettes = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
	    
	     $response->getBody()->write(json_encode($recettes));
	    return $response;
	    
        //echo json_encode($recettes);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});
//GET liste regime
$app->get('/api/regimes', function(Request $request, Response $response){


$sql="Select * from regime";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $regime = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
	    
	     $response->getBody()->write(json_encode($regime));
	    return $response;
	    
       // echo json_encode($frigo);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});
//GET liste regime
$app->get('/api/regime/{id_regime}', function(Request $request, Response $response){
    $id_regime = $request->getAttribute('id_regime');

$sql="Select * from regime where id_regime = $id_regime";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $regime = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
	    
	     $response->getBody()->write(json_encode($regime));
	    return $response;
	    
       // echo json_encode($frigo);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});


// Update Frigo
$app->post('/api/frigo/update/{id_user}', function(Request $request, Response $response ,$args){
	
    $id_user = $request->getAttribute('id_user');
	$input = $request->getParsedBody();
    $id_ingrd = $input['id_ingrd'];
    $quantite = $input['quantite'];
    $id_unite = $input['id_unite'];
	
   

    $sql = "REPLACE into frigo(id_user,id_ingrd,quantite,id_unite) values($id_user,:id_ingrd,:quantite,:id_unite)
			WHERE id_ingrd = :id_ingrd and id_user = $id_user" ;

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':id_ingrd', $id_ingrd);
        $stmt->bindParam(':quantite',  $quantite);
	$stmt->bindParam(':id_unite',  $id_unite);
       

        $stmt->execute();

	     $response->getBody()->write('{"notice": {"text": "Frigo Updated"}');
	    return $response;
	    
       // echo '{"notice": {"text": "Frigo Updated"}';

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});


