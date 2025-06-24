<?php
include 'config/koneksi.php';
session_start();

$id_order = $_GET['id'];
$id_level = isset($_SESSION['ID_LEVEL']) ? $_SESSION['ID_LEVEL'] : '';

$query = mysqli_query($config, "SELECT 
    trans_order_detail.*, 
    trans_order.*, 
    customer.customer_name, 
    type_of_service.* 
FROM trans_order_detail 
LEFT JOIN type_of_service ON trans_order_detail.id_service = type_of_service.id 
LEFT JOIN trans_order ON trans_order_detail.id_order = trans_order.id 
LEFT JOIN customer ON trans_order.id_customer = customer.id 
WHERE trans_order.id = '$id_order'");
$row = mysqli_fetch_all($query, MYSQLI_ASSOC);

$queryLevel = mysqli_query($config, "SELECT * FROM level WHERE id='$id_level'");
$rowLevel = mysqli_fetch_assoc($queryLevel);

$tanggal = $row[0]['created_at'] ?? date("Y-m-d H:i:s");
$jam = explode(" ", $tanggal)[1];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wakey Laundry | Kalibata City</title>
    <style>
    body {
        font-family: 'Courier New', Courier, monospace;
        width: 80mm;
        margin: auto;
        padding: 10px;
    }

    .struk {
        text-align: center;
    }

    .line {
        margin: 5px 0;
        border-top: 1px dashed black;
    }

    .info {
        text-align: center;
    }

    .service,
    .summary {
        text-align: left;
    }

    .service .item {
        margin-bottom: 5px;
    }

    .item-qty {
        display: flex;
        justify-content: space-between;
    }

    .row {
        display: flex;
        justify-content: space-between;
        margin: 2px 0;
    }

    footer {
        text-align: center;
        font-size: 13px;
        margin-top: 10px;
    }

    @media print {
        body {
            width: 80mm;
            margin: 0;
        }
    }
    </style>
</head>

<body>
    <div class="struk">
        <div class="info">
            <h3>Wakey Laundry || KALIBATA CITY</h3>
            <p>sayyidumar11@gmail.com</p>
            <p>Jl.Cipinang Jaya aa ujung, Kamp.Besar, Jatinegara</p>
            <p>085772169466</p>
        </div>
        <div class="line"></div>
        <div class="info">
            <div class="row">
                <span><?php echo $row[0]['order_date'] ?></span>
                <span><?php echo $jam ?></span>
            </div>
            <div class="row">
                <span><?php echo $rowLevel['level_name'] ?? '-' ?></span>
                <span><?php echo $_SESSION['NAME'] ?? '-' ?></span>
            </div>
            <div class="row">
                <span>Order Id:</span>
                <span><?php echo $row[0]['order_code'] ?></span>
            </div>
            <div class="row">
                <span>Customer:</span>
                <span><?php echo $row[0]['customer_name'] ?></span>
            </div>
        </div>
        <div class="line"></div>

        <?php foreach ($row as $r): ?>
        <div class="service">
            <div class="item">
                <strong><?= $r['service_name'] ?></strong>
                <div class="item-qty">
                    <span><?= number_format($r['qty'], 2, ',', '.') ?> kg x
                        Rp<?= number_format($r['price'], 0, ',', '.') ?></span>
                    <span>Rp <?= number_format($r['subtotal'], 0, ',', '.') ?></span>
                </div>
            </div>
        </div>
        <?php endforeach; ?>

        <div class="line"></div>
        <div class="summary">
            <div class="row">
                <span>Total</span>
                <span>Rp <?= number_format($row[0]['total'], 0, ',', '.') ?></span>
            </div>
            <div class="row">
                <span>Bayar</span>
                <span>Rp <?= number_format($row[0]['order_pay'], 0, ',', '.') ?></span>
            </div>
            <div class="line"></div>
            <div class="row">
                <span>Kembalian</span>
                <span>Rp <?= number_format($row[0]['order_change'], 0, ',', '.') ?></span>
            </div>
        </div>
        <div class="line"></div>
        <footer>Terima kasih telah menggunakan layanan kami!</footer>
    </div>

    <?php if (isset($_GET['print']) && $_GET['print'] === 'true'): ?>
    <script>
    window.onload = function() {
        window.print();
        setTimeout(() => window.close(), 1000);
    };
    </script>
    <?php endif; ?>
</body>

</html>