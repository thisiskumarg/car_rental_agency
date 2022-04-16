<div class="col-sm-12">
    <h2 class="text-center text-success text-uppercase my-4">My Booked Cars</h2>
    <table class="table table-hover table-responsive">
        <thead>
            <tr class="text-success">
                <th>S. No.</th>
                <th>Vehicle Model</th>
                <th>Vehicle Number</th>
                <th>Seating Capacity</th>
                <th>Rent/Day (in Rs.)</th>
                <th>Start Date</th>
                <th>End Date</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $sno = 0;
            foreach($booked_cars as $cars) {

                $today_date = date('M d, Y');
                $end_date = date('M d, Y', strtotime($cars['start_date'].' + '.$cars['rent_days'].' days'));
                $first_date = strtotime($today_date);
                $last_date = strtotime($end_date);

            ?>
                <tr>
                    <td><?= ++$sno.'.'; ?></td>
                    <td><?= $cars['vehicle_model']; ?></td>
                    <td><?= $cars['vehicle_number']; ?></td>
                    <td><?= $cars['seating_capacity']; ?></td>
                    <td><?= $cars['rent_per_day']; ?></td>
                    <td><?= date('M d, Y', strtotime($cars['start_date'])); ?></td>
                    <td><?= date('M d, Y', strtotime($cars['end_date'])); ?></td>
                </tr>
            <?php 
            }
            
            ?>
        </tbody>
    </table>
</div>