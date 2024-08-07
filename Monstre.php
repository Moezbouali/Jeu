<?php
include_once 'Personnage.php';

abstract class Monstre extends Personnage {
    protected $mechancete;

    public function __construct(int $musculation, int $lachete, int $inteligence, int $endurance, int $sante, int $mechancete) {
        parent::__construct($musculation, $lachete, $inteligence, $endurance, $sante);
        $this->mechancete = $mechancete;
    }

    abstract public function rugir(Personnage $hero): void;
    abstract public function coupDesalete(Personnage $hero): void;
}
?>