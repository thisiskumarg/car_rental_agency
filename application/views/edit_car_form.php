<div class="col-sm-12">
    <h2 class="text-center text-success text-uppercase my-4 mt-5">Edit Car Details</h2>
    <div class="col-sm-6 mx-auto">
        <form id="edit_car_form" method="post">
            <div class="row">
                <label class="text-success col-sm-4 col-form-label">Vehicle Registration ID <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                    <?= $car_details[0]['vehicle_id']; ?>
                </div>
            </div>
            <div class="row mt-3">
                <label for="vehicle_model" class="text-success col-sm-4 col-form-label">Vehicle Model <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                    <input type="text" name="vehicle_model" id="vehicle_model" class="form-control" value="<?= $car_details[0]['vehicle_model']; ?>">
                    <span id="vehicle_modelerr" class="text-danger" style="display: none;">Please Enter Vehicle Model!</span>
                </div>
            </div>
            <div class="row mt-3">
                <label for="vehicle_number" class="text-success col-sm-4 col-form-label">Vehicle Number <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                    <input type="text" name="vehicle_number" id="vehicle_number" class="form-control" value="<?= $car_details[0]['vehicle_number']; ?>">
                    <span id="vehicle_numbererr" class="text-danger" style="display: none;">Please Enter Vehicle Number!</span>
                </div>
            </div>
            <div class="row mt-3">
                <label for="seat_capacity" class="text-success col-sm-4 col-form-label">Seating Capacity <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                    <input type="text" name="seat_capacity" id="seat_capacity" class="form-control" value="<?= $car_details[0]['seating_capacity']; ?>">
                    <span id="seat_capacityerr" class="text-danger" style="display: none;">Please Enter Seating Capacity!</span>
                </div>
            </div>
            <div class="row mt-3">
                <label for="day_rent" class="text-success col-sm-4 col-form-label">Rent/Day (in Rs.) <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                    <input type="text" name="day_rent" id="day_rent" class="form-control" value="<?= $car_details[0]['rent_per_day']; ?>">
                    <span id="day_renterr" class="text-danger" style="display: none;">Please Enter Rent/Day!</span>
                </div>
            </div>
            <div class="text-center">
                <button type="button" id="update_car_details" class="btn btn-success text-uppercase mt-4">Update Car Details</button>
            </div>
        </form>
    </div>
</div>

<script src="<?php echo base_url('js/jquery.min.js'); ?>"></script>

<script>

    $("#update_car_details").click(function() {

        var vehicle_model = $("#vehicle_model").val();
        var vehicle_number = $("#vehicle_number").val();
        var seat_capacity = $("#seat_capacity").val();
        var day_rent = $("#day_rent").val();
        err = 0;

        if(vehicle_model == "") {
            
            $("#vehicle_modelerr").show();
            err += 1;
        } else {

            $("#vehicle_modelerr").hide();
        }

        if(vehicle_number == "") {
            
            $("#vehicle_numbererr").show();
            err += 1;
        } else {

            $("#vehicle_numbererr").hide();
        }

        if(seat_capacity == "") {
            
            $("#seat_capacityerr").show();
            err += 1;
        } else {

            $("#seat_capacityerr").hide();
        }

        if(day_rent == "") {
            
            $("#day_renterr").show();
            err += 1;
        } else {

            $("#day_renterr").hide();
        }

        if(err == 0) {

            $.ajax({

                type: "POST",
                url: "<?php echo site_url('welcome/update_car_details/').$car_details[0]['vehicle_id']; ?>",
                data: {vehicle_model: vehicle_model, vehicle_number: vehicle_number, seat_capacity: seat_capacity, day_rent: day_rent},
                beforeSend: function() {},
                success: function(data) {

                    if(data == 1) {

                        alert('Car details is updated successfully.');
                        window.location.href = "<?php echo site_url('welcome/index/'); ?>";
                    }else if(data == 2) {

                        alert('This Vehicle Number or Vehicle Model is already added!');
                        window.location.href = "<?php echo site_url('welcome/edit_car_form/').$car_details[0]['vehicle_id']; ?>";
                    } else if(data == 0) {

                        alert('All fields are mandatory!');
                        window.location.reload();
                    }
                }
            });
        }
    });

</script>