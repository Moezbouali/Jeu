<?php
include_once 'Hero.php';

class Princesse extends Hero {
    public function __construct() {
        parent::__construct(6, 2, 15, 120, 100, 6);
    }

    public function gifle(Monstre $monstre): void {
        $monstre->recevoirDegats(10);
    }

    public function coupspecial(Monstre $monstre): void {
        $monstre->recevoirDegats(12);
    }
}
?>