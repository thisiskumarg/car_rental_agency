<div class="col-sm-12">
    <h2 class="text-center text-success text-uppercase my-4">All Booked Cars</h2>
    <table class="table table-hover table-responsive">
        <thead>
            <tr class="text-success">
                <th>S. No.</th>
                <th>Vehicle Model</th>
                <th>Vehicle Number</th>
                <th>Seating Capacity</th>
                <th>Rent/Day (in Rs.)</th>
                <th>Customer Register ID</th>
                <th>Customer Name</th>
                <th>No of Days</th>
                <th>Start Date</th>
                <th>End Date</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $sno = 0;
            foreach($allbooked_cars as $bookedcars) {
            
            ?>
                <tr>
                    <td><?= ++$sno.'.'; ?></td>
                    <td><?= $bookedcars['vehicle_model']; ?></td>
                    <td><?= $bookedcars['vehicle_number']; ?></td>
                    <td><?= $bookedcars['seating_capacity']; ?></td>
                    <td><?= $bookedcars['rent_per_day']; ?></td>
                    <td><?= $bookedcars['register_id']; ?></td>
                    <td><?= $bookedcars['name']; ?></td>
                    <td><?= $bookedcars['rent_days']; ?></td>
                    <td><?= date('M d, Y', strtotime($bookedcars['start_date'])); ?></td>
                    <td><?= date('M d, Y', strtotime($bookedcars['end_date'])); ?></td>
                </tr>
            <?php 
            }
            
            ?>
        </tbody>
    </table>
</div>