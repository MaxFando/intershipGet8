<?php 

use Phalcon\Tag;
use Phalcon\Mvc\Controller;

class PostController extends Controller
{
    
    public function indexAction()
    {
        $this->view->setVar('posts', Posts::find());
    }

    public function detailAction($id)
    {
        $post = Posts::findById($id);

        if(!$post) {
            die("test");
            $this->flash->error("Post not found");
            $this->dispatcher->forward(array(
                'controller' => 'post',
                'action' => 'index'
            ));
        }

        $this->view->setVar('post', $post);
    }

    public function showAction()
    {
        $posts = Posts::find();
        $this->view->setVar('pageTitle', 'Posts');
        $this->view->setVar('posts', $posts);

    }

    public function createAction()
    {
        $posts = new Posts();


        $posts->title = $this->request->get('title');
        $posts->body = $this->request->get('body');

        $success = $posts->save();

        if ($success) {
            $this->response->redirect('/post/show');
        } else {
            echo "Sorry, the following problems were generated: ";

            $messages = $posts->getMessages();

            foreach ($messages as $message) {
                echo $message->getMessage(), "<br/>";
            }
        }

        $this->view->disable();
    }

    public function editAction($id)
    {
        $posts = Posts::findById($id);
        if(!$posts) {
            $this->flash->error("Post wasn't found");
            return $this->dispatcher->forward([
                'action' => 'show'
            ]);
        }

        if ($this->request->isPost()) {
            $posts->title = $this->request->getPost('title');
            $posts->body = $this->request->getPost('body');

            if ($posts->save()) {
                $this->flash->error($posts->getMessages());
            } else {
                $this->flash->success('Post was updated sucessfully');
            }

            Tag::resetInput();
        }
    }

    public function deleteAction($id)
    {
        $posts = Posts::findById($id);

        if ($posts !== false) {
            if($posts->delete() === false) {
                echo "Sorry we can't";

                $messages = $posts-getMessages();

                foreach ($messages as $message) {
                    echo $message, "\n";
                }
            } else {
                echo 'Удалено';
            }
        }
    }
}

?>