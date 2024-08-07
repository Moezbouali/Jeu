<?php
class Lutin {
    private $lachete;
    private $musculation;
    private $mechancete;
    private $salete;
    private $endurance;
    private $sante;

    public function __construct() {
        $this->lachete = 10;
        $this->musculation = 8;
        $this->mechancete = 8;
        $this->salete = 15;
        $this->endurance = 100;
        $this->sante = 100;
    }

    public function getLachete() {
        return $this->lachete;
    }

    public function getMusculation() {
        return $this->musculation;
    }

    public function getMechancete() {
        return $this->mechancete;
    }

    public function getSalete() {
        return $this->salete;
    }

    public function getEndurance() {
        return $this->endurance;
    }

    public function getSante() {
        return $this->sante;
    }

    public function rugir($cible) {
        $dommages = $this->musculation * 1.5; // Dommages basés sur la musculation
        $cible->recevoirDommages($dommages);
        echo "Le lutin a rugi et a infligé $dommages dégâts à l'ennemi!";
    }

    public function coupDesalete($cible) {
        $dommages = $this->salete; // Dommages basés sur la saleté
        $cible->recevoirDommages($dommages);
        echo "Le lutin a utilisé son coup de saleté et a infligé $dommages dégâts à l'ennemi!";
    }

    public function recevoirDommages($dommages) {
        $this->sante -= $dommages;
        if ($this->sante < 0) $this->sante = 0;
    }

    public function estVivant() {
        return $this->sante > 0;
    }
}
?>