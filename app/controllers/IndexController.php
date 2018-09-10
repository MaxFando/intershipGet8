<?php 

use Phalcon\Mvc\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        $posts = Posts::find();

        $this->view->setVars(
            [
                'posts' => array_reverse($posts)
            ]
        );
    }
}