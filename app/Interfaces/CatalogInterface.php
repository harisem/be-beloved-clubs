<?php

namespace App\Interfaces;

interface CatalogInterface
{
    public function getAll();
    public function getOne($slug);
    public function getHeader();
}