<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../config/db.php");
include("../templates/header.php");

// Sprawdzenie, czy użytkownik jest zalogowany
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$message = "";

// Pobranie danych użytkownika
$query = "SELECT user_name, email FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo "<p>Błąd: nie można pobrać danych użytkownika.</p>";
    include("../templates/footer.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Kod do obsługi formularza...
}

?>

<div class="profile-edit-container">
    <h2>Edytuj Profil</h2>
    <?php if (!empty($message)): ?>
        <p class="message"><?php echo $message; ?></p>
    <?php endif; ?>
    <form method="POST" class="profile-edit-form">
        <label for="username">Nazwa użytkownika:</label>
        <input type="text" name="username" id="username" value="<?php echo $user['user_name']; ?>" required>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo $user['email']; ?>" required>

        <hr>

        <label for="current_password">Aktualne hasło:</label>
        <input type="password" name="current_password" id="current_password">

        <label for="new_password">Nowe hasło:</label>
        <input type="password" name="new_password" id="new_password">

        <label for="confirm_password">Potwierdź nowe hasło:</label>
        <input type="password" name="confirm_password" id="confirm_password">

        <input type="submit" value="Zapisz zmiany">
    </form>
</div>

<?php
include("../templates/footer.php");
?>
