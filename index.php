<?php  
include 'config/koneksi.php';
//Session 
session_start();
if(isset($_POST['email'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $queryLogin = mysqli_query($config, "SELECT * FROM user WHERE email='$email' AND password='$password'");


  if (mysqli_num_rows($queryLogin) > 0) {
    // header("location:namafile.php"): "meredirect / lempar ke halaman lain"
    $rowLogin = (mysqli_fetch_assoc($queryLogin));
    $_SESSION['ID_USER'] = $rowLogin['id'];
    $_SESSION['NAME'] = $rowLogin['name'];
    // $_SESSION['ID_ROLE'] = $role ;

    header("location:home.php");
  } else {
    header("location:index.php?login=error");
  }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Laundry</title>
    <link rel="stylesheet" href="assets/css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous" />
    <!-- Font Awesome CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="assets/css/style.css" />


</head>

<body>
    <div class="bg-blur"></div>
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="assets/img/logo/logo.png  " class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form action="" method="post">
                        <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                            <p class="text-white lead fw-normal mb-0 me-3">Sign in with</p>
                            <button type="button" data-mdb-button-init data-mdb-ripple-init
                                class="btn btn-light btn-floating mx-1">
                                <i class="fa-brands fa-instagram"></i>
                            </button>

                            <button type="button" data-mdb-button-init data-mdb-ripple-init
                                class="btn btn-light btn-floating mx-1">
                                <i class="fa-solid fa-envelope"></i>
                            </button>

                        </div>

                        <div class="divider d-flex align-items-center my-4">
                            <p class="text-white text-center fw-bold mx-3 mb-0">Or</p>
                        </div>

                        <!-- Email input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="email" name="email" id="form3Example3" class="form-control form-control-lg"
                                placeholder="Enter a valid email address" />
                            <label class="text-white form-label" for="form3Example3">Email address</label>
                        </div>

                        <!-- Password input -->
                        <div data-mdb-input-init class="form-outline mb-3">
                            <input type="password" name="password" id="form3Example4"
                                class="form-control form-control-lg" placeholder="Enter password" />
                            <label class="text-white form-label" for="form3Example4">Password</label>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Checkbox -->
                            <div class="form-check mb-0">
                                <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                                <label class="text-white form-check-label" for="form2Example3">
                                    Remember me
                                </label>
                            </div>
                            <a href="#!" class="text-white">Forgot password?</a>
                        </div>

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" data-mdb-button-init data-mdb-ripple-init
                                class="text-white btn btn-primary btn-lg"
                                style=" padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                            <p class="text-white small fw-bold mt-2 pt-1 mb-0 pb-3">Don't have an account? <a href="#!"
                                    class="text-white text-white link-danger">Register</a></p>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </section>


    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>