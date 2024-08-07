<?php
interface PersonnageInterface {
    public function estVivant(): bool;
    public function recevoirDegats(int $degats): void;
    public function getSante(): int;
    public function afficherCaracteristiques(): string;
}
?>