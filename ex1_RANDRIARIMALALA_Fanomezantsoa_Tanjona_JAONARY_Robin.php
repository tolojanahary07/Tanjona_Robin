<?php
class Produit
{
    public string $nom;
    public float $prix;
    public int $quantite;
    // Constructeur 
    public function __construct($nom, $prix, $quantite)
    {
        $this->nom = $nom;
        $this->prix = $prix;
        $this->quantite = $quantite;
    }
    // La valeur stock
    public function valeurStock()
    {
        return $this->prix * $this->quantite;
    }
    // Vend une quantité de produits si le stock est suffisant
    public function vendre($qte)
    {
        if ($this->quantite >= $qte) {
            $this->quantite = $this->quantite - $qte;
        } else {
            echo "Vente impossible : stock insuffisant pour " . $this->nom . "<br>";
        }
    }
    // Afficher une ligne de tableau
    public function afficher()
    {
        echo $this->nom . "  | "
            . $this->prix . " Ar | "
            . $this->quantite . " | "
            . $this->valeurStock() . " Ar <br>";
    }
}

// Création des objets Produit
$riz = new Produit("Riz", 3500, 40);
$huile = new Produit("Huile", 9000, 12);
$sucre = new Produit("Sucre", 3800, 25);

// Effectuer les ventes
$riz->vendre(15);
$huile->vendre(20);
// changer le prix du sucre
$sucre->prix = 4200;
// Placer les produits dans un tableau
$produits = [$riz, $huile, $sucre];

// Afficher le tableau des produits
echo "<h3>Nom | Prix | Quantite | Valeur stock</h3>";
$totalStock = 0;
for ($i = 0; $i < count($produits); $i++) {
    $produits[$i]->afficher();
    $totalStock = $totalStock + $produits[$i]->valeurStock();
}
// Afficher la valeur totale
echo "<br>Valeur totale du stock : " . $totalStock . " Ar";
?>
