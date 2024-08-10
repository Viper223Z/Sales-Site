<?php
session_start();
include("../config/db.php");

// Wyłączanie wyświetlania błędów PHP w środowisku produkcyjnym
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);

$error_message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_name = $_POST['user_name'];
    $user_surname = $_POST['user_surname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_repeat = $_POST['password_repeat'];
    $nick = $_POST['nick'];
    $phone = $_POST['phone']; // Dodano pole telefonu

    if (!empty($user_name) && !empty($email) && !empty($user_surname) && !empty($password) && !empty($password_repeat) && !empty($nick) && !empty($phone)) {
        if ($password !== $password_repeat) {
            $error_message = "Hasła nie są zgodne.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_message = "Nieprawidłowy format adresu email.";
        } elseif (strlen($password) > 30) {
            $error_message = "Hasło nie może przekraczać 30 znaków.";
        } elseif (!ctype_digit($phone)) {
            $error_message = "Numer telefonu może zawierać tylko cyfry.";
        } else {
            // Sprawdzenie, czy nick już istnieje
            $query = "SELECT id FROM users WHERE nick = ?";
            if ($stmt = $conn->prepare($query)) {
                $stmt->bind_param("s", $nick);
                $stmt->execute();
                $stmt->store_result();

                if ($stmt->num_rows > 0) {
                    $error_message = "Nick jest już zajęty.";
                } else {
                    $stmt->close();

                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                    // Generowanie unikalnego identyfikatora
                    $id = uniqid('', true);
                    $query = "INSERT INTO users (id, user_name, user_surname, email, password, nick, phone) VALUES (?, ?, ?, ?, ?, ?, ?)";
                    if ($stmt = $conn->prepare($query)) {
                        $stmt->bind_param("sssssss", $id, $user_name, $user_surname, $email, $hashed_password, $nick, $phone);

                        if ($stmt->execute()) {
                            header("Location: login.php");
                            die;
                        } else {
                            $error_message = "Błąd: " . $stmt->error;
                        }

                        $stmt->close();
                    } else {
                        $error_message = "Błąd przygotowania zapytania: " . $conn->error;
                    }
                }
            } else {
                $error_message = "Błąd przygotowania zapytania: " . $conn->error;
            }
        }
    } else {
        $error_message = "Wszystkie pola są wymagane!";
    }
}

include("../templates/header.php");
?>

<h2>Rejestracja</h2>
<form method="post" class="auth-form">
    <label for="user_name">Imię:</label>
    <input type="text" name="user_name" id="user_name" required><br><br>
    <label for="user_surname">Nazwisko:</label>
    <input type="text" name="user_surname" id="user_surname" required><br><br>
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required><br><br>
    <label for="nick">Nick:</label>
    <input type="text" name="nick" id="nick" required><br><br>
    <label for="phone">Nr telefonu:</label>
    <input type="tel" name="phone" id="phone" required><br><br>
    <label for="password">Hasło:</label>
    <input type="password" name="password" id="password" required maxlength="30"><br><br>
    <label for="password_repeat">Powtórz hasło:</label>
    <input type="password" name="password_repeat" id="password_repeat" required maxlength="30"><br><br>
    <input type="submit" value="Zarejestruj się">
    <?php if (!empty($error_message)): ?>
        <p class="error"><?php echo $error_message; ?></p>
    <?php endif; ?>
</form>
