<div class="col-sm-12">
    <h2 class="text-center text-success text-uppercase my-4 mt-5"><?= $user; ?> Register</h2>
    <div class="col-sm-6 mx-auto">
        <form id="register_form" method="post">
            <div class="row">
                <label for="name" class="text-success col-sm-3 col-form-label"><?= $user; ?> Name <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <input type="text" name="name" id="name" class="form-control">
                    <span id="nameerr1" class="text-danger" style="display: none;">Please Enter Name!</span>
                    <span id="nameerr2" class="text-danger" style="display: none;">Only Alphabets & Spaces are allowed!</span>
                </div>
            </div>
            <div class="row my-3">
                <label for="addr" class="text-success col-sm-3 col-form-label"><?= $user; ?> Address <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <input type="text" name="addr" id="addr" class="form-control">
                    <span id="addrerr" class="text-danger" style="display: none;">Please Enter <?= $user; ?> Address!</span>
                </div>
            </div>
            <div class="row my-3">
                <label for="mobile" class="text-success col-sm-3 col-form-label"><?= $user; ?> Mobile <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <input type="tel" name="mobile" id="mobile" class="form-control" minlength="10" maxlength="10">
                    <span id="mobileerr1" class="text-danger" style="display: none;">Please Enter mobile!</span>
                    <span id="mobileerr3" class="text-danger" style="display: none;">Please enter valid length mobile!</span>
                    <span id="mobileerr2" class="text-danger" style="display: none;">Only Numbers are allowed!</span>
                </div>
            </div>
            <div class="row my-3">
                <label for="mail" class="text-success col-sm-3 col-form-label"><?= $user; ?> User Name/E-Mail <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <input type="email" name="mail" id="mail" class="form-control">
                    <span id="mailerr1" class="text-danger" style="display: none;">Please Enter User Name or E-Mail!</span>
                    <span id="mailerr2" class="text-danger" style="display: none;">Please enter valid User Name or E-Mail!</span>
                </div>
            </div>
            <div class="row my-3">
                <label for="pwd" class="text-success col-sm-3 col-form-label">Password <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <input type="password" name="pwd" id="pwd" class="form-control">
                    <span id="pwderr1" class="text-danger" style="display: none;">Please enter Password!</span>
                    <span id="pwderr2" class="text-danger" style="display: none;">Please enter valid Password!</span>
                </div>
            </div>
            <div class="text-center">
                <input type="hidden" name="role" id="role" value="<?php echo $user; ?>">
                <button type="button" id="register" class="btn btn-success text-uppercase mt-4">Get Registered</button>
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

    $("#register").click(function() {

        var name = $("#name").val();
        var addr = $("#addr").val();
        var mobile = $("#mobile").val();
        var mail = $("#mail").val();
        var pwd = $("#pwd").val();
        var role = $("#role").val();
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

        if(mobile != "") {

            if(mobile.length != 10) {

                $("#mobileerr1").hide();
                $("#mobileerr3").show();
                $("#mobileerr2").hide();
                err2 += 1;
            } else {

                $("#mobileerr1").hide();
                $("#mobileerr3").hide();
                $("#mobileerr2").hide();
            }
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
                url: "<?php echo site_url('welcome/signup/'); ?>",
                data: {name: name, addr: addr, mobile: mobile, mail: mail, pwd: pwd, role: role},
                beforeSend: function() {},
                success: function(data) {

                    if(data == 1) {

                        alert('Your data is saved successfully.');
                        window.location.href = "<?php echo site_url('welcome/login/'); ?>";
                    } else if(data == 2) {

                        alert('This Mobile or User Name / E-Mail is already registered!');
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