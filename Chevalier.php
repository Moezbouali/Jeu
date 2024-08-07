<?php
include_once 'Hero.php';

class Chevalier extends Hero {
    public function __construct() {
        parent::__construct(15, 5, 8, 100, 100, 12);
    }

    public function gifle(Monstre $monstre): void {
        $monstre->recevoirDegats(15);
    }

    public function coupspecial(Monstre $monstre): void {
        $monstre->recevoirDegats(8);
    }
}
?>