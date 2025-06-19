<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Bootstrap & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <!-- Navbar (Hanya muncul di HP) -->
    <nav class="navbar navbar-dark bg-dark d-md-none">
        <div class="container-fluid">
            <button class="btn btn-outline-light" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>
            <span class="navbar-brand">My Dashboard</span>
        </div>
    </nav>

    <div class="bg-blur"></div>
    <div class="background d-flex">
        <!-- Include Sidebar -->
        <?php include "inc/sidebar.php"; ?>

        <!-- Konten utama -->
        <div class="flex-grow-1 p-4" id="mainContent">
            <?php 
                  if (isset($_GET['page'])) {
              if (file_exists("content/" . $_GET['page'] . ".php")) {
              include ('content/' . $_GET['page'] . ".php");
                } else {
                    include 'content/notFound.php';
                  }
          } else {
            include 'content/order_pickup.php';
            
          }
            ?>
        </div>
    </div>

    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/viewSidebar.js"></script>
</body>

</html>