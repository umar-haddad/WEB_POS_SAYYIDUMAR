  <!-- Pages Customer Info -->
  <?php 

// jadi kita ambil dulu id dari trans_laundry_pickupnya, ambil table notes dari trans_order_detail dari trans_laundry_pickupnya, 
// nah join sepertu biasa tapi yang detail gausah karena dia udah di select secara individu 
$query = mysqli_query($config, "SELECT 
    trans_order.*,
    customer.customer_name,
    (
        SELECT notes 
        FROM trans_order_detail 
        WHERE trans_order_detail.id_order = trans_order.id 
        LIMIT 1
    ) AS notes
FROM trans_order
LEFT JOIN customer ON trans_order.id_customer = customer.id
ORDER BY trans_order.id DESC");

$rows = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>


  <div class="row">
      <?php foreach ($rows as $row): ?>
      <div class="col-md-4 mb-4">
          <div class="receipt-card card p-1">
              <div class="receipt-line">ID : <?= $row['order_code'] ?></div>
              <div class="receipt-line">Customer : <?= $row['customer_name'] ?></div>
              <div class="receipt-line">Total : Rp <?= number_format($row['total'], 0, ',', '.') ?></div>
              <div class="receipt-line">Notes : <?= !empty($row['notes']) ? $row['notes'] : '-' ?></div>
              <div class="receipt-dash">----------------------------------------------</div>
              <div class="d-flex justify-content-between align-items-end mt-3">
                  <p
                      class="text-muted large rounded p-1 <?= $row['order_status'] == 1 ? 'btn btn-secondary' : 'btn btn-success' ?>">
                      Status :
                      <?= $row['order_change'] > 0 ? 'Selesai' : 'Proses' ?>
                  </p>
                  <!-- Tombol Pay -->
                  <?php ?> p
                  <a href="?page=save-payment&id=<?= $row['id'] ?>" class="btn btn-sm btn-success m-2"
                      data-id="<?= $row['id'] ?>">Pay</a>
              </div>
          </div>
      </div>
      <?php endforeach; ?>
  </div>