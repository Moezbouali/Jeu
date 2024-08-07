<?php
include_once 'Objet.php';

class Arme extends Objet {
    private $bonusDegats;

    public function __construct($nom, $bonusDegats) {
        parent::__construct($nom, 'arme');
        $this->bonusDegats = $bonusDegats;
    }

    public function appliquerEffet(Personnage $personnage) {
        $personnage->augmenterDegats($this->bonusDegats);
    }
}
?>