<?php
include_once 'Objet.php';

class Armure extends Objet {
    private $bonusDefense;

    public function __construct($nom, $bonusDefense) {
        parent::__construct($nom, 'armure');
        $this->bonusDefense = $bonusDefense;
    }

    public function appliquerEffet(Personnage $personnage) {
        $personnage->augmenterDefense($this->bonusDefense);
    }
}
?>