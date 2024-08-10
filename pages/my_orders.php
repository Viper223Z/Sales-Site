<?php
session_start();
include("../config/db.php");
include("../templates/header.php");

$user_id = $_SESSION['user_id'];  // Zakładam, że ID użytkownika jest przechowywane w sesji

$query = "SELECT order_items.id AS order_item_id, offers.title, offers.price, order_items.quantity, offers.image 
          FROM order_items 
          JOIN offers ON order_items.offer_id = offers.id 
          JOIN users ON order_items.user_id = users.id 
          WHERE users.id = ?";

$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id); // 'i' jako typ integer
$stmt->execute();
$result = $stmt->get_result();

?>

<h2>Moje Zamówienia</h2>
<div class="orders-container">
    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="order-item">
                <div class="order-item-image">
                    <img src="../uploads/<?php echo $row['image']; ?>" alt="<?php echo $row['title']; ?>">
                </div>
                <div class="order-item-details">
                    <h3>Zamówienie nr <?php echo $row['order_item_id']; ?></h3>
                    <h4><?php echo $row['title']; ?></h4>
                    <p>Cena jednostkowa: <span class="price"><?php echo $row['price']; ?> PLN</span></p>
                    <p>Ilość: <?php echo $row['quantity']; ?></p>
                    <p>Łączna cena: <span class="total-price"><?php echo $row['price'] * $row['quantity']; ?> PLN</span></p>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>Nie masz żadnych zamówień.</p>
    <?php endif; ?>
</div>

<?php
include("../templates/footer.php");
?>
