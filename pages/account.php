<?php
session_start();
include("../templates/header.php");
?>

<div class="account-container">
    <h2>Moje Konto</h2>
    <div class="account-options">
        <a href="edit_profile.php" class="account-option">
            <div class="icon">👤</div>
            <div class="text">Edytuj Profil</div>
        </a>
        <a href="my_orders.php" class="account-option">
            <div class="icon">📦</div>
            <div class="text">Moje Zamówienia</div>
        </a>
        <a href="logout.php" class="account-option">
            <div class="icon">🚪</div>
            <div class="text">Wyloguj się</div>
        </a>
    </div>
</div>

<?php
include("../templates/footer.php");
?>
