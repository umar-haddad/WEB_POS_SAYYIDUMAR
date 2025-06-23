<?php 
session_start(); 
ob_start(); 
include "config/koneksi.php"; 

$name = isset($_SESSION['NAME']) ? $_SESSION['NAME'] : '';
$currentPage = isset($_GET['page']) ? $_GET['page'] : '';
?>
<div id="sidebar" class="bg-dark text-white p-3 sidebar ">
    <a href="/" class="d-flex align-items-center mb-3 text-white text-decoration-none">
        <i class="fas fa-rocket fs-4 me-2"></i>
        <span class="fs-5">MyPanel</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li>
            <a href="?page=order_pickup"
                class="nav-link <?= $currentPage == 'order_pickup' ? 'active bg-secondary' : 'text-white' ?>">
                <i class="fas fa-home me-2"></i>Dashboard
            </a>
        </li>
        <li>
            <a href="?page=trans_order"
                class="nav-link <?= $currentPage == 'trans_order' ? 'active bg-secondary' : 'text-white' ?>">
                <i class="fas fa-pen me-2"></i>Input Order
            </a>
        </li>
        <li>
            <a href="?page=trans_order_detail"
                class="nav-link <?= $currentPage == 'trans_order_detail' ? 'active bg-secondary' : 'text-white' ?>">
                <i class="fas fa-photo-video me-2"></i>Detail Order
            </a>
        </li>
        <hr>
        <a href="/" class="d-flex align-items-center mb-3 text-white text-decoration-none">
            <i class="fa-solid fa-book px-2"></i>
            <span class="fs-5">Master Data</span>
        </a>
        <li>
            <a href="?page=user" class="nav-link <?= $currentPage == 'user' ? 'active bg-secondary' : 'text-white' ?>">
                <i class="fas fa-users me-2"></i>Users
            </a>
        </li>
        <li>
            <a href="?page=customer"
                class="nav-link <?= $currentPage == 'customer' ? 'active bg-secondary' : 'text-white' ?>">
                <i class="fas fa-cog me-2"></i>Customer
            </a>
        </li>
        <li>
            <a href="?page=service"
                class="nav-link <?= trim($currentPage) == 'service' ? 'active bg-secondary' : 'text-white' ?>">
                <i class="fas fa-sliders-h me-2"></i>Service
            </a>
        </li>
    </ul>
    <hr>
    <div class="form-check form-switch text-white">
        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
    </div>
    <div class="d-flex align-items-center gap-2 p-2">
        <i class="fa-solid fa-circle-user"></i>
        <span class="fw-semibold text-light"><?= $name ?></span>
    </div>
    <div class="mt-3">
        <a href="logout.php" class="btn btn-secondary w-100">
            <i class="fas fa-sign-out-alt me-2"></i>Logout
        </a>
    </div>
</div>