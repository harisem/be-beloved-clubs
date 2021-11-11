<?php

namespace App\Interfaces;

interface ProductInterface
{
    public function getProducts($query);
    public function getProductById($id);
    public function getProductBySlug($slug);
}