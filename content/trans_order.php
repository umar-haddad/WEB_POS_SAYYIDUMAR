<!-- Pages Customer Info -->

<?php 
$query = mysqli_query($config, "SELECT trans_order.*, customer.customer_name,
    (
        SELECT notes 
        FROM trans_order_detail 
        WHERE trans_order_detail.id_order = trans_order.id 
        LIMIT 1
    ) AS notes
    FROM trans_order
    LEFT JOIN customer ON trans_order.id_customer = customer.id 
    WHERE trans_order.deleted_at IS NULL
    ORDER BY trans_order.id DESC");
$rows = mysqli_fetch_all($query, MYSQLI_ASSOC);



?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-white"> Data User</h5>
                <div class="mb-3" align="right">
                    <a href="?page=tambah-trans_order" class="btn btn-primary">Add</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-secondary">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Customer</th>
                                <th>ID</th>
                                <th>waktu Order</th>
                                <th>notes</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($rows as $key => $row): ?>
                            <tr>
                                <td><?php echo $key += 1; ?></td>
                                <td><?php echo $row['customer_name'] ?></td>
                                <td><?php echo $row['order_code'] ?></td>
                                <td><?php echo $row['order_date']  ?></td>
                                <td><?php echo $row['notes']  ?></td>
                                <td>
                                    <!-- <a href="?page=tambah-instructor-major&id=" class="btn btn-primary">Add
                    major</a> -->
                                    <a href="?page=tambah-trans_order&edit=<?php echo $row ['id']?>"
                                        class="btn btn-primary">Edit</a>
                                    <a onclick="return confirm('bener gak mau dihapus?')"
                                        href="?page=tambah-trans_order&delete=<?php echo $row ['id']?>"
                                        class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>