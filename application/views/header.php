<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title;?></title>
    <link rel="stylesheet" href="<?php echo base_url('dist/css/bootstrap.min.css'); ?>">
</head>
<body>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-dark bg-success">
            <div class="container-fluid">
                <a href="<?php echo site_url('welcome/index/'); ?>" class="navbar-brand text-uppercase">Car Rental Agency</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="menu">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?php echo site_url('welcome/index/'); ?>">Home ( Available Cars )</a>
                        </li>
                    <?php 
                    if($this->session->has_userdata('id')) {
                    
                    ?>
                        <li class="nav-item">
                            <a class="nav-link active" href="<?php echo site_url('welcome/get_profile_data/'); ?>">Profile</a>
                        </li>
                        <?php 
                        if($this->session->userdata('role') == 'Agency') {
                        
                        ?>
                            <li class="nav-item">
                                <a class="nav-link active" href="<?php echo site_url('welcome/add_car_form/'); ?>">Add Car Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="<?php echo site_url('welcome/all_booked_cars/'); ?>">View Booked Cars</a>
                            </li>
                        <?php 
                        } else if($this->session->userdata('role') == 'Customer') {
                        
                        ?>
                            <li class="nav-item">
                                <a class="nav-link active" href="<?php echo site_url('welcome/my_booked_cars/'); ?>">My Booked Cars</a>
                            </li>
                        <?php 
                        }
                        
                        ?>
                        <li class="nav-item">
                            <a class="nav-link active" href="<?php echo site_url('welcome/logout/'); ?>">Logout</a>
                        </li>
                    <?php 
                    } else {
                    
                    ?>
                        <li class="nav-item">
                            <a class="nav-link active" href="<?php echo site_url('welcome/login/'); ?>">Login</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Register
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="<?php echo site_url('welcome/register?name=Customer'); ?>">As Customer</a></li>
                                <li><a class="dropdown-item" href="<?php echo site_url('welcome/register?name=Agency'); ?>">As Agency</a></li>
                            </ul>
                        </li>
                    <?php 
                    }
                    ?>
                    </ul>
                </div>
            </div>
        </nav>
    