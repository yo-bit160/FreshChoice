<?php
// Database connectie
$mysqli = new mysqli("localhost", "root", "", "dashboard");

// Algemene voorraadstatus
$totalVoorraad = $mysqli->query("SELECT SUM(hoeveelheid) AS totaal FROM voorraad")->fetch_assoc()['totaal'];

// Voorraad per categorie
$perCategorie = $mysqli->query("
    SELECT categorieen.naam, SUM(voorraad.hoeveelheid) AS totaal
    FROM voorraad
    INNER JOIN categorieen ON categorieen.id = voorraad.categorie_id
    GROUP BY categorie_id
");

// Tekorten
$tekorten = $mysqli->query("
    SELECT voorraad.productnaam, tekorten.melding
    FROM tekorten
    INNER JOIN voorraad ON voorraad.id = tekorten.product_id
");

// Leveranciers
$leveranciers = $mysqli->query("SELECT naam, status FROM leveranciers");

// Klanten
$klanten = $mysqli->query("SELECT naam, activiteiten FROM klanten");

// Verkoop statistieken
$verkoop = $mysqli->query("
    SELECT voorraad.productnaam, aantal_verkocht, omzet
    FROM verkoop 
    INNER JOIN voorraad ON voorraad.id = verkoop.product_id
");

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboard voorraad.css">
  </head>
  <body>
    <div class="hoofd">

      <!-- 1. Algemene voorraadstatus -->
      <div class="een">
        <div class="een-header">Algemene Voorraadstatus</div>
        <div class="een-body">
            <p><b>Totale voorraad:</b> <?php echo $totalVoorraad; ?> producten</p>
        </div>
      </div>  
      
      <!-- 2. Voorraad per categorie -->
      <div class="twee">
        <div class="twee-header">Voorraad per categorie</div>
        <div class="twee-body">
          <?php while($row = $perCategorie->fetch_assoc()): ?>
            <p><b><?= $row['naam'] ?>:</b> <?= $row['totaal'] ?></p>
          <?php endwhile; ?>
        </div>
      </div>
      
      <!-- 3. Urgente tekorten -->
      <div class="drie">
        <div class="drie-header">Urgente tekorten</div>
        <div class="drie-body">
          <?php while($row = $tekorten->fetch_assoc()): ?>
            <p>⚠ <b><?= $row['productnaam'] ?></b> — <?= $row['melding'] ?></p>
          <?php endwhile; ?>
        </div>
      </div>

      <!-- 4. Leveranciers -->
      <div class="vier">
        <div class="vier-header">Leveranciers en Bestellingen</div>
        <div class="vier-body">
          <?php while($row = $leveranciers->fetch_assoc()): ?>
            <p><b><?= $row['naam'] ?></b> — Status: <?= $row['status'] ?></p>
          <?php endwhile; ?>
        </div>
      </div>  

      <!-- 5. Klantgegevens -->
      <div class="vijf">
        <div class="vijf-header">Klantgegevens</div>
        <div class="vijf-body">
          <?php while($row = $klanten->fetch_assoc()): ?>
            <p><b><?= $row['naam'] ?>:</b> <?= $row['activiteiten'] ?></p>
          <?php endwhile; ?>
        </div>
      </div>

      <!-- 6. Verkoopstatistieken -->
      <div class="zes">
        <div class="zes-header">Verkoopstatistieken</div>
        <div class="zes-body">
          <?php while($row = $verkoop->fetch_assoc()): ?>
            <p>
              <b><?= $row['productnaam'] ?></b> — 
              Verkocht: <?= $row['aantal_verkocht'] ?> stuks — 
              Omzet: €<?= $row['omzet'] ?>
            </p>
          <?php endwhile; ?>
        </div>
      </div>

    </div>
  </body>
</html>
