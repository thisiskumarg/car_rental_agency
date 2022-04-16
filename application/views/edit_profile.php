<div class="col-sm-12">
    <h2 class="text-center text-success text-uppercase my-4 mt-5">Your Profile</h2>
    <div class="col-sm-6 mx-auto mt-5">
        <form id="edit_profile" method="POST">
            <div class="row">
                <label for="mail" class="text-success col-sm-4 col-form-label">Registered ID</label>
                <div class="col-sm-8">
                    <?php echo $get_profile[0]['register_id']; ?>
                </div>
            </div>
            <div class="row mt-3">
                <label for="mail" class="text-success col-sm-4 col-form-label">Name <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                    <input type="text" name="name" id="name" class="form-control" value="<?php echo $get_profile[0]['name']; ?>">
                    <span id="nameerr1" class="text-danger" style="display: none;">Please Enter Name!</span>
                    <span id="nameerr2" class="text-danger" style="display: none;">Only Alphabets & Spaces are allowed!</span>
                </div>
            </div>
            <div class="row mt-3">
                <label for="mail" class="text-success col-sm-4 col-form-label">Mobile <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                    <input type="text" name="mobile" id="mobile" class="form-control" value="<?php echo $get_profile[0]['mobile']; ?>">
                    <span id="mobileerr1" class="text-danger" style="display: none;">Please Enter mobile!</span>
                    <span id="mobileerr2" class="text-danger" style="display: none;">Only Numbers are allowed!</span>
                </div>
            </div>
            <div class="row mt-3">
                <label for="mail" class="text-success col-sm-4 col-form-label">User Name / E-Mail <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                    <input type="email" name="mail" id="mail" class="form-control" value="<?php echo $get_profile[0]['mail']; ?>">
                    <span id="mailerr1" class="text-danger" style="display: none;">Please Enter User Name or E-Mail!</span>
                    <span id="mailerr2" class="text-danger" style="display: none;">Please enter valid User Name or E-Mail!</span>
                </div>
            </div>
            <div class="row mt-3">
                <label for="mail" class="text-success col-sm-4 col-form-label">Address <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                    <input type="text" name="addr" id="addr" class="form-control" value="<?php echo $get_profile[0]['address']; ?>">
                    <span id="addrerr" class="text-danger" style="display: none;">Please Enter Your Address!</span>
                </div>
            </div>
            <div class="row mt-3">
                <label for="mail" class="text-success col-sm-4 col-form-label">Password <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                    <input type="password" name="pwd" id="pwd" class="form-control" value="<?php echo $get_profile[0]['passwrd']; ?>">
                    <span id="pwderr1" class="text-danger" style="display: none;">Please enter Password!</span>
                    <span id="pwderr2" class="text-danger" style="display: none;">Please enter valid Password!</span>
                </div>
            </div>
            <div class="text-center">
                <button type="button" id="update" class="btn btn-success text-uppercase mt-4">Get Updated</button>
            </div>
        </form>
    </div>
</div>

<script src="<?php echo base_url('js/jquery.min.js'); ?>"></script>

<script>

    $("#name").keypress(function(evt) {
        
        var inputValue = evt.which;
        if(!(inputValue >= 65 && inputValue <= 90) && !(inputValue >= 97 && inputValue <= 122) && inputValue != 32) {
            $("#nameerr1").hide();
            $("#nameerr2").show();
            return false;
        } else {
            $("#nameerr1").hide();
            $("#nameerr2").hide();
        }
        
    });
    
    $("#mobile").keypress(function(evt) {
        
        var inputValue = evt.which;
        if(!(inputValue >= 48 && inputValue <= 57)) {
            $("#mobileerr1").hide();
            $("#mobileerr2").show();
            return false;
        } else {
            $("#mobileerr1").hide();
            $("#mobileerr2").hide();
        }
        
    });

    $("#update").click(function() {

        var name = $("#name").val();
        var addr = $("#addr").val();
        var mobile = $("#mobile").val();
        var mail = $("#mail").val();
        var pwd = $("#pwd").val();
        var err1 = 0;
        var err2 = 0;

        if(name == "") {

            $("#nameerr1").show();
            $("#nameerr2").hide();
            err1 += 1;
        } else {

            $("#nameerr1").hide();
            $("#nameerr2").hide();
        }

        if(addr == "") {

            $("#addrerr").show();
            err1 += 1;
        } else {

            $("#addrerr").hide();
        }

        if(mobile == "") {

            $("#mobileerr1").show();
            $("#mobileerr2").hide();
            err1 += 1;
        } else {

            $("#mobileerr1").hide();
            $("#mobileerr2").hide();
        }

        if(mail == "") {

            $("#mailerr1").show();
            $("#mailerr2").hide();
            err1 += 1;
        } else {

            $("#mailerr1").hide();
            $("#mailerr2").hide();
        }

        if(pwd == "") {

            $("#pwderr1").show();
            $("#pwderr2").hide();
            err1 += 1;
        } else {

            $("#pwderr1").hide();
            $("#pwderr2").hide();
        }

        if(mail != "") {

            var re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail);
            if(!re) {

                $("#mailerr1").hide();
                $("#mailerr2").show();
                err2 += 1;
            } else {

                $("#mailerr1").hide();
                $("#mailerr2").hide();
            }
        }

        if(pwd != "") {

            var re = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/.test(pwd);
            if(!re) {

                $("#pwderr1").hide();
                $("#pwderr2").show();
                err2 += 1;
            } else {

                $("#pwderr1").hide();
                $("#pwderr2").hide();
            }
        }

        if(err1 == 0 && err2 == 0) {

            $.ajax({

                type: "POST",
                url: "<?php echo site_url('welcome/update_profile_data/'); ?>",
                data: {name: name, addr: addr, mobile: mobile, mail: mail, pwd: pwd},
                beforeSend: function() {},
                success: function(data) {

                    if(data == 1) {

                        alert('Your data is updated successfully.');
                        window.location.href = "<?php echo site_url('welcome/get_profile_data/'); ?>";
                    } else if(data == 2) {

                        alert('This Mobile or User Name / E-Mail is already registered!');
                        window.location.href = "<?php echo site_url('welcome/edit_profile_data/'); ?>";
                    } else if(data == 0) {

                        alert('All fields are mandatory!');
                        window.location.href = "<?php echo site_url('welcome/edit_profile_data/'); ?>";
                    }
                }
            });
        }
    });
    
</script>