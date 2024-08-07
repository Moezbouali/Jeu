<?php
include_once 'Monstre.php';

class Ogre extends Monstre {
    protected $arme;

    public function __construct() {
        parent::__construct(10, 3, 0, 100, 100, 12);
        $this->arme = new Arme("Massue", 15);
    }

    public function rugir(Personnage $hero): void {
        $hero->recevoirDegats(5);
    }

    public function coupDesalete(Personnage $hero): void {
        $hero->recevoirDegats(15);
    }
}
?>