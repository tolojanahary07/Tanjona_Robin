<?php
class Employe
{
    public String $matricule;
    public String $nom;
    public String $salaireBase;

    // Constructeur 
    public function __construct($matricule, $nom, $salaireBase)
    {
        $this->matricule = $matricule;
        $this->nom = $nom;
        $this->salaireBase = $salaireBase;
    }
    public function calculerSalaire()
    {
        return $this->salaireBase;
    }
    public function getType()
    {
        return "Employe";
    }
    // Affiche les informations de l'employé
    public function afficher()
    {
        echo $this->matricule . " | ";
        echo $this->nom . " | ";
        echo $this->getType() . " | ";
        echo $this->calculerSalaire() . " Ar<br>";
    }
}
class Manager extends Employe
{
    public $prime;
    // Le constructeur 
    public function __construct($matricule, $nom, $salaireBase, $prime)
    {
        parent::__construct($matricule, $nom, $salaireBase);
        $this->prime = $prime;
    }
    // Salaire
    public function calculerSalaire()
    {
        return parent::calculerSalaire() + $this->prime;
    }
    public function getType()
    {
        return "Manager";
    }
}
// Heritage employe
class Commercial extends Employe
{
    public $ventes;
    public $taux;
    public function __construct($matricule, $nom, $salaireBase, $ventes, $taux)
    {
        parent::__construct($matricule, $nom, $salaireBase);
        $this->ventes = $ventes;
        $this->taux = $taux;
    }

    // Salaire = salaire de base + commission sur les ventes
    public function calculerSalaire()
    {
        $commission = $this->ventes * $this->taux / 100;
        return parent::calculerSalaire() + $commission;
    }
    public function getType()
    {
        return "Commercial";
    }
}
class Stagiaire extends Employe
{
    public function calculerSalaire()
    {
        return parent::calculerSalaire() * 30 / 100;
    }
    public function getType()
    {
        return "Stagiaire";
    }
}
// IMPORTANT : afficher() n'est pas redéfinie dans les classes filles.
// Elles héritent de cette méthode depuis Employe. Cette méthode appelle
// getType() et calculerSalaire(). PHP utilise automatiquement les versions
// redéfinies dans la classe de l'objet (Manager, Commercial ou Stagiaire).

// Création des employés
$personnel = [
    new Employe("E01", "Rabe", 600000),
    new Manager("M01", "Rakoto", 1200000, 400000),
    new Commercial("C01", "Rasoa", 500000, 8000000, 5),
    new Commercial("C02", "Hery", 500000, 3000000, 5),
    new Employe("E02", "Fara", 650000),
    new Stagiaire("S01", "Tiana", 600000)
];

// Afficher les employés et calculer les informations demandées
echo "Matricule | Nom | Type | Salaire<br>";

$masseSalariale = 0;
$nombreCommerciaux = 0;
$meilleurEmploye = null;
$salaireMaximum = 0;
// Parcourir le tableau avec la boucle for
for ($i = 0; $i < count($personnel); $i++) {
    // Afficher chaque employé
    $personnel[$i]->afficher();
    // Récupérer le salaire de l'employé
    $salaire = $personnel[$i]->calculerSalaire();
    // Calculer la masse salariale
    $masseSalariale = $masseSalariale + $salaire;
    // Compter les commerciaux
    if ($personnel[$i] instanceof Commercial) {
        $nombreCommerciaux++;
    }
    // Chercher l'employé le mieux payé
    if ($salaire > $salaireMaximum) {
        $salaireMaximum = $salaire;
        $meilleurEmploye = $personnel[$i];
    }
}
// Afficher les résultats
echo "<br>Masse salariale : " . $masseSalariale . " Ar<br>";
echo "Nombre de commerciaux : " . $nombreCommerciaux . "<br>";
echo "Salaire le plus eleve : " . $meilleurEmploye->nom;
?>
