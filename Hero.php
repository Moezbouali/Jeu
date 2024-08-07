<?php
include_once 'Personnage.php';

abstract class Hero extends Personnage {
    protected $epee;

    public function __construct(int $musculation, int $lachete, int $inteligence, int $endurance, int $sante, int $epee) {
        parent::__construct($musculation, $lachete, $inteligence, $endurance, $sante);
        $this->epee = $epee;
    }

    abstract public function gifle(Monstre $monstre): void;
    abstract public function coupspecial(Monstre $monstre): void;
}
?>