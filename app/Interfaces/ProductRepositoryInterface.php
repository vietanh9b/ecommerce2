<?php


namespace App\Interfaces;

interface ProductRepositoryInterface
{

    public function getAllProductWithSlugOfCategory($slug);

}