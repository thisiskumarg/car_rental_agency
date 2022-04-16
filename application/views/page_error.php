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
    <div class="container">
        <h2 class="text-center text-danger text-uppercase" style="margin-top: 25%;">User_Page_Error: You can not do this activity!</h2>
        <div class="text-center mt-3">
            <a href="<?php echo site_url('welcome/get_profile_data/'); ?>" class="btn btn-success">Go to Your Profile</a>
        </div>
    </div>
</body>
</html>