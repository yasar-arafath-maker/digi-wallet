<?php
session_start();
include __DIR__ . '/db_connect.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];

// Fetch user balance from DB
$stmt = $conn->prepare("SELECT balance FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($balance);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard - Digital Wallet</title>
    <link rel="stylesheet" href="css/styles.css" />
</head>
<body>

<header>Digital Wallet - Dashboard</header>

<div class="container">
    <h2>Welcome, <?php echo htmlspecialchars($user_name); ?>!</h2>
    <p>Your current balance is: <strong>₹<?php echo number_format($balance, 2); ?></strong></p>

    <div style="margin-top: 20px;">
        <a href="add_funds.php"><button>Add Funds</button></a>
        <a href="make_payment.php"><button>Make Payment</button></a>
        <a href="transactions.php"><button>View Transactions</button></a>
        <a href="logout.php"><button>Logout</button></a>
    </div>
</div>

</body>
</html>
