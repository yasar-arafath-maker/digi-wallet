<?php
session_start();
include __DIR__ . '/db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $amount = floatval($_POST['amount']);
    $method = trim($_POST['method']);

    // Check current balance
    $stmt = $conn->prepare("SELECT balance FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($balance);
    $stmt->fetch();
    $stmt->close();

    if ($amount <= 0) {
        $error = "Enter a valid amount.";
    } elseif ($amount > $balance) {
        $error = "Insufficient balance.";
    } else {
        $conn->begin_transaction();

        try {
            // Deduct balance
            $stmt = $conn->prepare("UPDATE users SET balance = balance - ? WHERE id = ?");
            $stmt->bind_param("di", $amount, $user_id);
            $stmt->execute();

            // Insert transaction record
            $type = 'debit';
            $stmt = $conn->prepare("INSERT INTO transactions (user_id, type, amount, method) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("isds", $user_id, $type, $amount, $method);
            $stmt->execute();

            $conn->commit();
            $success = "Payment successful!";
        } catch (Exception $e) {
            $conn->rollback();
            $error = "Payment failed. Try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Make Payment - Digital Wallet</title>
    <link rel="stylesheet" href="css/styles.css" />
</head>
<body>

<header>Digital Wallet - Make Payment</header>

<div class="container">
    <h2>Make Payment</h2>

    <?php if ($error): ?>
        <p style="color: maroon;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <?php if ($success): ?>
        <p style="color: hotpink;"><?php echo htmlspecialchars($success); ?></p>
    <?php endif; ?>

    <form method="POST" action="make_payment.php">
        <label for="amount">Amount (₹):</label><br />
        <input type="number" step="0.01" id="amount" name="amount" required /><br /><br />

        <label for="method">Payment Method:</label><br />
        <select id="method" name="method" required>
            <option value="Credit Card">Credit Card</option>
            <option value="Debit Card">Debit Card</option>
            <option value="Bank Transfer">Bank Transfer</option>
            <option value="Cryptocurrency">Cryptocurrency</option>
        </select><br /><br />

        <button type="submit">Pay</button>
    </form>

    <br />
    <a href="dashboard.php">Back to Dashboard</a>
</div>

</body>
</html>
