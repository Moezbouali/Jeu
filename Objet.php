<?php
abstract class Objet {
    protected $nom;
    protected $type; // 'arme', 'armure', etc.

    public function __construct($nom, $type) {
        $this->nom = $nom;
        $this->type = $type;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getType() {
        return $this->type;
    }

    abstract public function appliquerEffet(Personnage $personnage);
}
?>