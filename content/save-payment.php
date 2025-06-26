<?php
$id_order = $_GET['id'];
$query = mysqli_query($config, "SELECT * FROM trans_order WHERE id ='$id_order'");
$rows = mysqli_fetch_all($query, MYSQLI_ASSOC);

$total = $rows[0]['total'] ?? 0;    


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_pay = $_POST['order_pay']; 
    $order_end_date = date('Y-m-d H:i:s') ;

    if ($order_pay < $total) {
        echo "<script>alert('Uang anda tidak cukup');</script>";
    } else {
        $order_change = $order_pay - $total;

        $updateQ = mysqli_query($config, "UPDATE trans_order 
            SET order_pay = '$order_pay', order_change = '$order_change', order_end_date='$order_end_date', order_status = 0 
            WHERE id ='$id_order' ");

            if ($updateQ) {
                $queryOrder = mysqli_query($config, "SELECT id_customer, order_end_date FROM trans_order WHERE id = '$id_order'");
                $dataOrder = mysqli_fetch_assoc($queryOrder);

                $id_customer = $dataOrder['id_customer'];
                 $pickup_date = $order_end_date;    

                // Ambil notes dari salah satu trans_order_detail (kalau ada)
                $notesQuery = mysqli_query($config, "SELECT notes FROM trans_order_detail WHERE id_order = '$id_order' LIMIT 1");
                $notesData = mysqli_fetch_assoc($notesQuery);
                $notes = $notesData['notes'] ?? '-';


                $insertOrder = mysqli_query($config, "INSERT INTO trans_laundry_pickup (id_order, id_customer, pickup_date, notes) 
                VALUES ('$id_order', '$id_customer', '$pickup_date', '$notes')");   

            }

        if ($updateQ) {
    echo "<script>  
        document.addEventListener('DOMContentLoaded', function () {
            var myModal = new bootstrap.Modal(document.getElementById('payModal'));
            myModal.show();
            setTimeout(function () {
                window.location.href = '?page=order_pickup&id=$id_order&bayar=berhasil';
            }, 2000);
        });
    </script>";
}

}   
}
?>

<form method="POST">
    <div class="form-box d-flex justify-content-center mt-5">
        <div class="card col-6  ">
            <div class="card-body" style="background-color:  rgb(102, 91, 91);">


                <div class="mb-2">
                    <label class="total-label">Total :</label>
                    <span class="btn btn-success"><?php echo $total ?></span>
                </div>

                <div class="mb-2">
                    <label class="total-label mb-2">Bayar :</label>
                    <input type="number" step="any" name="order_pay" class="form-control " required>
                </div>

                <div class="mb-2 mt-3" align="center">
                    <button type="submit" class="btn btn-sm btn-success" style="width: 100px; height: auto;"
                        data-bs-toggle="modal">Pay</button>
                </div>
            </div>
        </div>
    </div>
</form>


<!-- Modal -->
<div class="modal fade" id="payModal" tabindex="-1" aria-labelledby="payModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-success-subtle text-center rounded-4 p-4 border border-success">
            <div class="modal-body">
                <!-- Gambar Bulat -->
                <img src="assets/img/sankyu.jpg" class="rounded-circle mb-3" alt="Success Image">

                <!-- Tulisan -->
                <h5 class="fw-bold">sankyu...</h5>

                <!-- Icon Centang -->
                <div class="mt-3">
                    <i class="fas fa-check-circle text-success" style="font-size: 50px;"></i>
                </div>
                <div>

                </div>
            </div>
        </div>
    </div>
</div>