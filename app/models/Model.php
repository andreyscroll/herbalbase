<?php

namespace Models;

class Model
{
    protected $conn = null;

    public function __construct()
    {
        $this->conn = (new Database())->getConnection();
    }
}