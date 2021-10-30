<?php

namespace Models;

abstract class Model
{
    protected $conn = null;

    public function __construct()
    {
        $this->conn = Database::getConnection();
    }
}
