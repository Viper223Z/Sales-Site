<?php
session_start();
include("../config/db.php");

$error_message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    if (!empty($user_name) && !empty($password)) {
        $query = "SELECT * FROM users WHERE user_name = ? LIMIT 1";
        if ($stmt = $conn->prepare($query)) {
            $stmt->bind_param("s", $user_name);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows > 0) {
                $user_data = $result->fetch_assoc();
                if (password_verify($password, $user_data['password'])) {
                    $_SESSION['user_id'] = $user_data['id'];
                    header("Location: index.php");
                    die;
                } else {
                    $error_message = "Nieprawidłowa nazwa użytkownika lub hasło!";
                }
            } else {
                $error_message = "Nieprawidłowa nazwa użytkownika lub hasło!";
            }
            $stmt->close();
        } else {
            $error_message = "Błąd przygotowania zapytania: " . $conn->error;
        }
    } else {
        $error_message = "Wszystkie pola są wymagane!";
    }
}

include("../templates/header.php");
?>

<h2>Logowanie</h2>
<form method="post" class="auth-form">
    <label for="user_name">Nazwa użytkownika:</label>
    <input type="text" name="user_name" id="user_name"><br><br>
    <label for="password">Hasło:</label>
    <input type="password" name="password" id="password"><br><br>
    <input type="submit" value="Zaloguj się">
    <?php if ($error_message): ?>
        <p class="error"><?php echo $error_message; ?></p>
    <?php endif; ?>
    
        <p style="text-align: center;">Nie masz konta? <a href="register.php">Zarejestruj się</a></p>
    
</form>

<?php
include("../templates/footer.php");
?>
