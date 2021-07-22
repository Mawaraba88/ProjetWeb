<?php


namespace App\Classe;

use App\Entity\CategoryDonnees;
use App\Entity\Users;


class Search
{
    /**
     * @var string
     */
    public $string ="";

    /**
     * @var CategoryDonnees[]
     */
    public $categoriesDonnees = [];

    /**
     * @var Users[]
     */
    public $authors= [];

}