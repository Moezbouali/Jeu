<?php
include_once 'PersonnageInterface.php';
include_once 'Objet.php';

abstract class Personnage implements PersonnageInterface {
    protected $musculation;
    protected $lachete;
    protected $inteligence;
    protected $endurance;
    protected $sante;
    protected $experience;
    protected $niveau;
    protected $degatsBonus;
    protected $defenseBonus;
    protected $arme;
    protected $armure;

    public function __construct(int $musculation, int $lachete, int $inteligence, int $endurance, int $sante) {
        $this->musculation = $musculation;
        $this->lachete = $lachete;
        $this->inteligence = $inteligence;
        $this->endurance = $endurance;
        $this->sante = $sante;
        $this->experience = 0;
        $this->niveau = 1;
        $this->degatsBonus = 0;
        $this->defenseBonus = 0;
        $this->arme = null;
        $this->armure = null;
    }

    public function estVivant(): bool {
        return $this->sante > 0;
    }

    public function recevoirDegats(int $degats): void {
        $degatsReduits = max(0, $degats - $this->defenseBonus);
        $this->sante -= $degatsReduits;
        $this->afficherPortionDeSang();
    }

    public function getSante(): int {
        return $this->sante;
    }

    public function getMusculation(): int {
        return $this->musculation;
    }

    public function augmenterDegats(int $bonus): void {
        $this->degatsBonus += $bonus;
    }

    public function augmenterDefense(int $bonus): void {
        $this->defenseBonus += $bonus;
    }

    public function equiperObjet(Objet $objet): void {
        if ($objet->getType() === 'arme') {
            if ($this->arme) {
                $this->degatsBonus -= $this->arme->bonusDegats;
            }
            $this->arme = $objet;
        } elseif ($objet->getType() === 'armure') {
            if ($this->armure) {
                $this->defenseBonus -= $this->armure->bonusDefense;
            }
            $this->armure = $objet;
        }
        $objet->appliquerEffet($this);
    }

    public function afficherPortionDeSang(): void {
        echo "Une portion de sang a été versée! Santé restante: {$this->sante}.<br>";
    }

    public function gagnerExperience(int $points): void {
        $this->experience += $points;
        if ($this->experience >= $this->niveau * 100) {
            $this->monterNiveau();
        }
    }

    protected function monterNiveau(): void {
        $this->niveau++;
        $this->musculation += 5;
        $this->sante += 10;
        $this->experience = 0;
        echo "Niveau augmenté! Nouveau niveau: {$this->niveau}, Musculation: {$this->musculation}, Santé: {$this->sante}<br>";
    }

    public function afficherCaracteristiques(): string {
        return "Musculation: {$this->musculation}, Lâcheté: {$this->lachete}, Intelligence: {$this->inteligence}, Endurance: {$this->endurance}, Santé: {$this->sante}, Expérience: {$this->experience}, Niveau: {$this->niveau}, Dégâts Bonus: {$this->degatsBonus}, Défense Bonus: {$this->defenseBonus}";
    }
}
?>