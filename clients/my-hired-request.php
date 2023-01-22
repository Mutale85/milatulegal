<?php include("addons/body_top.php")?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php

                $query = $connect->prepare("SELECT * FROM table_legal_requests WHERE hire_status = 'hired' AND phonenumber = ? ");
                $query->execute([$_SESSION['phonenumber']]);
                foreach ($query->fetchAll() as $row) {
                    extract($row);
                    
                    $lawyer_id = getHiredLawyer($connect, $id);
            ?>
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title "><?php echo $case_title?></h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            
                            <div class="col-md-8">
                                <table class="table">
                                    <tr>
                                        <th>Date Posted: </th>
                                        <td><?php echo date("j F Y: H:i:s", strtotime($date_created))?></td>
                                    </tr>
                                    <tr>
                                        <th>Project Location</th>
                                        <td><?php echo getTown($connect, $town)?>, <?php echo getProvince($connect, $province);?></td>
                                    </tr>
                                    <tr>
                                        <th>Payment Preference</th>
                                        <td><?php echo $payment_mode?></td>
                                    </tr>
                                    <tr>
                                        <th>Lawyer Type</th>
                                        <td><?php echo $lawyer_type?></td>
                                    </tr>
                                </table>
                                <h4 class="text-primary">Project Details</h4>
                                <table class="table table-borderless">
                                    <tr>
                                        <th>Project Description</th>
                                        <td><?php echo htmlspecialchars_decode($description)?></td>
                                    </tr>
                                    
                                </table>
                            </div>
                            <div class="col-md-4">
                                <table class="table table-bordered">
                                    <tr>
                                    <th>Hired Lawyer</th>
                                    <td><a href="lawyerprofile?lawyer-apid=<?php echo base64_encode($lawyer_id)?>"><?php echo getUserByPhoneNumber($connect, $lawyer_id)?></a></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer"></div>
                </div>
                
            <?php 
                }
            ?>
        </div>
    </div>
</div>

<?php include("addons/body_bottom.php")?>

</body>

</html>