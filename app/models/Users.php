<?php

use Phalcon\Mvc\MongoCollection;

class Users extends MongoCollection
{
    public $id;
    public $name;
    public $email;
}