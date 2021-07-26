<?php


namespace App\Classe;

use App\Entity\CategoryDonnees;
use App\Entity\User;


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
     * @var \DateTime
     */
    public $searchDate = null;

}