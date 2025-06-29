  <!-- Pages Order_pickup struck -->
  <?php 

// jadi kita ambil dulu id dari trans_laundry_pickupnya, ambil table notes dari trans_order_detail dari trans_laundry_pickupnya, 
// nah join sepertu biasa tapi yang detail gausah karena dia udah di select secara individu 
$query = mysqli_query($config, "SELECT 
    trans_order.*,
    customer.customer_name,
    trans_laundry_pickup.pickup_date, 
    (
        SELECT notes 
        FROM trans_order_detail 
        WHERE trans_order_detail.id_order = trans_order.id 
        LIMIT 1
    ) AS notes
FROM trans_order
LEFT JOIN trans_laundry_pickup ON trans_order.id = trans_laundry_pickup.id_order
LEFT JOIN customer ON trans_order.id_customer = customer.id
ORDER BY trans_order.id DESC");

$rows = mysqli_fetch_all($query, MYSQLI_ASSOC);

?>


  <div class="row">
      <?php foreach ($rows as $row): ?>
      <div class="col-md-4 mb-4">
          <div class="receipt-card card p-1">
              <div class="receipt-line text-white">ID : <?= $row['order_code'] ?></div>
              <div class="receipt-line text-white">Customer : <?= $row['customer_name'] ?></div>
              <div class="receipt-line text-white">Total : Rp <?= number_format($row['total'], 0, ',', '.') ?></div>
              <div class="receipt-line text-white">Notes : <?= !empty($row['notes']) ? $row['notes'] : '-' ?></div>
              <div class="receipt-dash text-white">----------------------------------------------</div>
              <?php if(isset($row['pickup_date'])) : ?>
              <div class="receipt-line text-white">Order diambil : <?= $row['pickup_date'] ?></div>
              <?php endif ?>
              <div class="d-flex justify-content-between align-items-end mt-3 text-white">
                  <p
                      class="text-muted  large rounded p-1 <?= $row['order_status'] == 1 ? 'btn btn-secondary' : 'btn btn-success' ?>">
                      Status :
                      <?= $row['order_pay'] > 0 ? 'Selesai' : 'Proses' ?>
                  </p>
                  <!-- Tombol Pay -->
                  <?php  if(isset($row['order_status']) && $row['order_status'] == 1) : ?>
                  <a href="?page=save-payment&id=<?= $row['id'] ?>" class="btn btn-sm btn-success m-2"
                      data-id="<?= $row['id'] ?>"><i class="fa-solid fa-cash-register"></i> Pay</a>
                  <?php else : ?>
                  <a href="print_struck.php?id=<?= $row['id'] ?>&print=true" class="btn btn-sm btn-success m-2"><i
                          class="fas fa-print me-2"></i>Print</a>
                  <?php endif?>
              </div>
          </div>
      </div>
      <?php endforeach; ?>
  </div>