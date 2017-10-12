<?php
namespace App\Controller;
use Core\Controller;
use App\Model\ArticleModel;


/**
* 
*/
class ArticleController Extends Controller
{

	
    public function get($request, $response, $args) {
        // your code
        echo "get <br>";
        $articleModel = new ArticleModel();
        // var_dump($articleModel);
        // $articleModel->create([
        //   'attribut' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Temporibus, doloremque, iste? Commodi eum voluptatem rerum dolorem molestiae temporibus officia, quia voluptates dolores necessitatibus, dicta sit beatae voluptate earum tenetur labore?'
        // ]);
       	// echo($articleModel->lastSavedId());
		// $this->Users->update([
		//   'id' => 1,
		//   'email' => 'contato@arojunior.com'
		// ]);
		var_dump($articleModel->getAll());
        // to access items in the container... $this->container->get('');
        return $response;
    }


	// public function _invoke(Request $request, Response $response, array $args){
		// Sample log message
		// $this->logger->info("Slim-Skeleton '/article' route");

		// Render index view
		// return $this->renderer->render($response, 'article/index.php', $args);
	// }
}