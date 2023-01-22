<?php include("../includes/db.php")?>
<?php include("../includes/base.php")?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php 
    include("addons/header.php");
  ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?php include("addons/top_nav.php")?>

        <?php include("addons/side_nav.php")?>

        <div class="content-wrapper">
            <?php include("addons/content_head.php")?>
        
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="h4 mb-0 text-black-800 text-centers">Applications</h5>
                                </div>
                                <div class="card-body">
                                    
                                    <div class="table table-responsiv">
                                    
                                        <table class="table table-bordered" id="messageTable" style="width:100%;">
                                            <thead>
                                                <tr>
                                                    <th>Client</th>
                                                    <th>Case</th>
                                                    <th>View</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                    $query = $connect->prepare("SELECT * FROM table_applications WHERE lawyer_id = ? ");
                                                    $query->execute([$_SESSION['phonenumber']]);
                                                    foreach ($query->fetchAll() as $row) {
                                                        extract($row);
                                                        if($lawyer_opened == 0){
                                                            $seen_status = 'Open <i class="bi bi-arrow-right-square"></i>';
                                                        }else{
                                                            $seen_status = 'Opened <i class="bi bi-check-square"></i>';
                                                        }
                                                ?>
                                                <tr>
                                                    
                                                    <td><a href="lawyers/case-view-application?apid=<?php echo $id?>"><?php echo getUserByPhoneNumber($connect, $client_id)?></a></td>
                                                    <th><a href="lawyers/case-view-application?apid=<?php echo $id?>"> <?php echo  getLegalRequestName($connect, $case_id) ?></th>
                                                    <th><a href="lawyers/case-view-application?apid=<?php echo $id?>"> <?php echo $seen_status?></th>
                                                    <td><?php echo date("j F Y", strtotime($date_applied))?></td>
                                                    <td><?php echo checkEngamentStatus($connect, $client_id, $lawyer_id)?></td>
                                                </tr> 
                                                <?php 
                                                    }

                                                ?>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Engagement Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <span id="messageSpan"></span>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php include("addons/footer.php")?>
    
    </div>
    <?php include("addons/footerjs.php")?>
    <script>
        $(document).ready(function () {
            $('#messageTable').DataTable();
        });

        $(document).on("click", ".engaged", function(e){
            e.preventDefault();
            var applicationId = $(this).attr("href");
            

            $("#detailsModal").modal("show");

            $.ajax({
                url:"lawyers/processor/getEngamentDetails",
                method:"post",
                data:{applicationId:applicationId},
                
                success:function(data){
                    $("#messageSpan").html(data);
                }
            })
        })
    </script>

</body>

</html>