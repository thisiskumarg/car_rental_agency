<div class="col-sm-12">
    <h2 class="text-center text-success text-uppercase my-4 mt-5">Login</h2>
    <div class="col-sm-8 mx-auto">
        <form id="login_form" method="post">
            <div class="row">
                <label for="mail" class="text-success col-sm-4 col-form-label">User Name / E-Mail <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                    <input type="email" name="mail" id="mail" class="form-control">
                    <span id="mailerr" class="text-danger" style="display: none;">Please enter User Name or E-Mail!</span>
                    <span id="mailerr2" class="text-danger" style="display: none;">Invalid User Name or E-Mail!</span>
                </div>
            </div>
            <div class="row my-3">
                <label for="pwd" class="text-success col-sm-4 col-form-label">Password <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                    <input type="password" name="pwd" id="pwd" class="form-control">
                    <span id="pwderr" class="text-danger" style="display: none;">Please enter Password!</span>
                    <span id="pwderr2" class="text-danger" style="display: none;">Invalid Password!</span>
                </div>
            </div>
            <div class="text-center">
                <button type="button" id="login" class="btn btn-success text-uppercase mt-4">Get Profile</button>
            </div>
        </form>
    </div>
</div>

<script src="<?php echo base_url('js/jquery.min.js'); ?>"></script>

<script>

    $("#login").click(function() {

        var mail = $("#mail").val();
        var pwd = $("#pwd").val();
        err = 0;

        if(mail == "") {

            $("#mailerr").show();
            err += 1;
        } else {

            $("#mailerr").hide();
        }
        
        if(pwd == "") {

            $("#pwderr").show();
            err += 1;
        } else {

            $("#pwderr").hide();
        }

        if(err == 0) {
            
            $.ajax({

                type: "POST",
                url: "<?php echo site_url('welcome/signin/'); ?>",
                data: {mail: mail, pwd: pwd},
                beforeSend: function() {},
                success: function(data) {

                    if(data == 1) {

                        window.location.href = "<?php echo site_url('welcome/get_profile_data/'); ?>";
                    } else if(data == 2) {

                        alert('Invalid E-Mail or Password!');
                        window.location.reload();
                    } else if(data == 3) {

                        alert('Invalid User Name / E-Mail!');
                        window.location.reload();
                    } else if(data == 0) {

                        alert('All fields are mandatory!');
                        window.location.reload();
                    }
                }
            });
        }
    });
    
</script>