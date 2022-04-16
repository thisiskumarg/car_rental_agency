<div class="col-sm-12">
    <h2 class="text-center text-success text-uppercase my-4">Available Cars to Rent</h2>
    <table class="table table-hover table-responsive">
        <thead>
            <tr class="text-success">
                <th>S. No.</th>
                <th>Vehicle Model</th>
                <th>Vehicle Number</th>
                <th>Seating Capacity</th>
                <th>Rent/Day (in Rs.)</th>
            <?php 
            if($this->session->has_userdata('id') && $role == 'Customer') {
            
            ?>
                <th>No of Days</th>
                <th>Start Date</th>
            <?php 
            }
            
            ?>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $sno = 0;
            foreach($allcarsdata as $allcars) {
            
            ?>
                <tr>
                    <td><?= ++$sno.'.'; ?></td>
                    <td><?= $allcars['vehicle_model']; ?></td>
                    <td><?= $allcars['vehicle_number']; ?></td>
                    <td><?= $allcars['seating_capacity']; ?></td>
                    <td><?= $allcars['rent_per_day']; ?></td>
                <?php 
                if($this->session->has_userdata('id')) {
                    if($role == 'Customer') {
                
                ?>
                    <td>
                        <select name="rent_days<?= $sno; ?>" id="rent_days<?= $sno; ?>" class="form-control">
                            <option selected disabled>--- Choose Rent Days ---</option>
                            <?php 
                            for($rent_days = 1; $rent_days <= 31; $rent_days++) {
                            ?>
                                <option value="<?= $rent_days; ?>"><?= $rent_days; ?></option>
                            <?php 
                            }
                            ?>
                        </select>
                        <span id="rent_dayserr<?= $sno; ?>" class="text-danger" style="display: none;">Please select No of Days!</span>
                    </td>
                    <td>
                        <input type="date" name="start_date<?= $sno; ?>" id="start_date<?= $sno; ?>" min="<?php echo date('Y-m-d'); ?>" class="form-control">
                        <span id="start_dateerr<?= $sno; ?>" class="text-danger" style="display: none;">Please choose Start Date!</span>
                    </td>
                    <td>
                        <input type="hidden" name="vehicle_id<?= $sno; ?>" id="vehicle_id<?= $sno; ?>" value="<?php echo $allcars['vehicle_id']; ?>">
                        <button type="button" id="rent_car" onclick="rent_car(<?= $sno; ?>)" class="btn btn-success">Rent Car</button>
                    </td>
                <?php 
                    } elseif($role == 'Agency') {
                
                ?>
                    <td>
                        <a href="<?php echo site_url('welcome/edit_car_form/').$allcars['vehicle_id']; ?>" class="btn btn-success">Edit Car Details</a>
                    </td>
                <?php 
                    }
                } else {

                ?>
                    <td>
                        <a href="<?php echo site_url('welcome/login/'); ?>" class="btn btn-success">Rent Car</a>
                    </td>
                <?php 
                }

                ?>
                </tr>
            <?php 
            }
            
            ?>
        </tbody>
    </table>
</div>

<script src="<?php echo base_url('js/jquery.min.js'); ?>"></script>

<script>

    function rent_car(sno) {

        var rent_days = $("#rent_days"+sno).val();
        var start_date = $("#start_date"+sno).val();
        var vehicle_id = $("#vehicle_id"+sno).val();
        err = 0;

        if(rent_days == null) {

            $("#rent_dayserr"+sno).show();
            err += 1;
        } else {

            $("#rent_dayserr"+sno).hide();
        }
        
        if(start_date == "") {

            $("#start_dateerr"+sno).show();
            err += 1;
        } else {

            $("#start_dateerr"+sno).hide();
        }

        if(err == 0) {
            
            if(confirm('You are going to rent a car, do you want?')) {

                $.ajax({

                    type: "POST",
                    url: "<?php echo site_url('welcome/rent_car/'); ?>"+vehicle_id,
                    data: {rent_days: rent_days, start_date: start_date},
                    beforeSend: function() {},
                    success: function(data) {

                        if(data == 1) {

                            alert('Car is booked.');
                            window.location.href = "<?php echo site_url('welcome/my_booked_cars/'); ?>";
                        } else if(data == 0) {

                            alert('All fields are mandatory!');
                            window.location.reload();
                        }
                    }
                });
            }
        }
    }
    
</script>