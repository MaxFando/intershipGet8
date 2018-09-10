<?php

class Posts extends \Phalcon\Mvc\MongoCollection
{
    public $title;
    public $body;
    public $slug;
    public $created_at;

    public function onConstruct()
    {
        $this->created_at =  date('Y-m-d H-i-s', time());
    }

    public function getPostTitle() {
        return $this->title;
    }

    public function getPostContent() {
        return $this->body;
    }

    public function getPostSlug() {
        return $this->title;
    }

    public function beforeUpdate()
    {
        $this->modified_in = date('Y-m-d H:i:s');
    }

}