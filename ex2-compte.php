<?php
class CompteBancaire
{
    public string $numero;
    public string $titulaire;
    public float $solde;
    // Constructeur 
    public function __construct($numero, $titulaire, $solde)
    {
        $this->numero = $numero;
        $this->titulaire = $titulaire;
        $this->solde = $solde;
    }
    // Ajoute le montant au solde
    public function deposer($montant)
    {
        $this->solde = $this->solde + $montant;
    }
    // Retirer de l'argent si le solde est suffisant
    public function retirer($montant)
    {
        if ($this->solde >= $montant) {
            $this->solde = $this->solde - $montant;
            return true; 
        } else {
            echo "Retrait refuse sur " . $this->numero;
            echo " : solde insuffisant<br><br>";
            return false; 
        }
    }
    // Transférer de l'argent vers un autre compte
    public function virer($montant, $dest)
    {
        // On dépose chez le destinataire seulement si le retrait réussit
        if ($this->retirer($montant) == true) {
            $dest->deposer($montant);
        }
    }
    // Afficher les informations du compte
    public function afficher()
    {
        echo $this->numero . " | ";
        echo $this->titulaire . " | ";
        echo $this->solde . " Ar<br>";
    }
}
// Création des trois comptes
$rakoto = new CompteBancaire("CPT-001", "Rakoto", 500000);
$rasoa = new CompteBancaire("CPT-002", "Rasoa", 0);
$randria = new CompteBancaire("CPT-003", "Randria", 120000);
// Effectuer les opérations demandées
$rasoa->deposer(200000);
$rakoto->retirer(150000);
$randria->retirer(300000);

// Virements entre les comptes
$rakoto->virer(100000, $rasoa);
$rasoa->virer(50000, $randria);
// Ranger les comptes dans un tableau
$comptes = [$rakoto, $rasoa, $randria];
$totalSoldes = 0;
$nombreComptes = 0;

// Parcourir le tableau avec la boucle for
for ($i = 0; $i < count($comptes); $i++) {

    // Afficher les informations du compte
    $comptes[$i]->afficher();
    $nombreComptes++;
    $totalSoldes += $comptes[$i]->solde;
}

// Afficher les résultats
echo "Nombre de comptes : " . $nombreComptes . "<br>";
echo "Total des soldes : " . $totalSoldes . " Ar<br>";
?>
