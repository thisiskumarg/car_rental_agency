<div class="col-sm-12">
    <h2 class="text-center text-success text-uppercase my-4 mt-5">Your Profile</h2>
    <div class="col-sm-6 mx-auto mt-5">
        <form>
            <div class="row">
                <label for="mail" class="text-success col-sm-4 col-form-label">Registered ID</label>
                <div class="col-sm-8" style="padding-left: 200px;">
                    <?php echo $get_profile[0]['register_id']; ?>
                </div>
            </div>
            <div class="row">
                <label for="mail" class="text-success col-sm-4 col-form-label">Name</label>
                <div class="col-sm-8" style="padding-left: 200px;">
                    <?php echo $get_profile[0]['name']; ?>
                </div>
            </div>
            <div class="row">
                <label for="mail" class="text-success col-sm-4 col-form-label">Mobile</label>
                <div class="col-sm-8" style="padding-left: 200px;">
                    <?php echo $get_profile[0]['mobile']; ?>
                </div>
            </div>
            <div class="row">
                <label for="mail" class="text-success col-sm-4 col-form-label">User Name / E-Mail</label>
                <div class="col-sm-8" style="padding-left: 200px;">
                    <?php echo $get_profile[0]['mail']; ?>
                </div>
            </div>
            <div class="row">
                <label for="mail" class="text-success col-sm-4 col-form-label">Address</label>
                <div class="col-sm-8" style="padding-left: 200px;">
                    <?php echo $get_profile[0]['address']; ?>
                </div>
            </div>
            <div class="text-center">
                <a href="<?php echo site_url('welcome/edit_profile_data/'); ?>" class="btn btn-success text-uppercase mt-4">
                    Edit Profile
                </a>
            </div>
        </form>
    </div>
</div>