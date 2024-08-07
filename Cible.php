<?php
class Cible {
    private $sante;

    public function __construct() {
        $this->sante = 100; // Valeur initiale
    }

    public function recevoirDegats($degats) {
        $this->sante -= $degats;
    }

    public function afficherSante() {
        return $this->sante;
    }
}
?>