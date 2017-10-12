<?php
namespace App\Controller;
use Core\Controller;
use App\Model\ArticleModel;
use Slim\Container;


/**
* 
*/
class ArticleController Extends Controller
{

	public function __construct($container)
	{
		// Permet de récupérer le container de slim
		parent::__construct($container);
		// est appellé lors de l'appel du controller
	}
	
    public function home($request, $response, $args) 
    {
        // your code
        echo "home dans ArticleController <br>";
        $articleModel = new ArticleModel();
        $db = $articleModel->getDb();
    	$result = $db->article();
    	$rows = $result->fetchAll();
    	var_dump($rows);
    	echo "<br>";
    	echo "<br>";
    	foreach ($rows as $article) {
    		var_dump($article);
    		echo "<br>";
    		echo($article->content);
    	}
        // var_dump( get_class_methods(new ArticleModel()) );
        // $articleModel->row(['content' = "test"]);
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