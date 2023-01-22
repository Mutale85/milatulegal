<?php include("addons/body_top.php")?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1 class="h4 mb-0 text-black-800 text-centers">Applications</h1>
                    </div>
                    <div class="card-body">
                        
                        <div class="table table-responsiv">
                            <table class="table table-bordered" id="messageTable" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>Lawyer</th>
                                        <th>Case</th>
                                        <th>View</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                        $query = $connect->prepare("SELECT * FROM table_applications WHERE client_id = ? AND client_delete = '0' ");
                                        $query->execute([$_SESSION['phonenumber']]);
                                        foreach ($query->fetchAll() as $row) {
                                            extract($row);
                                            if($client_opened == 0){
                                                $seen_status = 'Open <i class="bi bi-arrow-right-square"></i>';
                                            }else{
                                                $seen_status = 'Opened <i class="bi bi-check-square"></i>';
                                            }
                                    ?>
                                    <tr>
                                        
                                        <td><a href="clients/application?apid=<?php echo $id?>"><?php echo getUserByPhoneNumber($connect, $lawyer_id)?></a></td>
                                        <td><?php echo getLegalRequestName($connect, $case_id)?></td>
                                        <th><a href="clients/application?apid=<?php echo $id?>"> <?php echo $seen_status?></th>
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
                    <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">x</button>
                </div>
                <div class="modal-body">
                    <span id="messageSpan"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php include("addons/body_bottom.php")?>       

    <script>
        $(document).ready(function () {
            $('#messageTable').DataTable();
        });
        $(function(){
            $(document).on("click", ".delete_message", function(e){
                e.preventDefault();
                var message_id = $(this).attr("href");
                if(confirm("You wish to delete the message you sent.")){
                    $.ajax({
                        url:"clients/processor/senderDeleteMessage",
                        method:"post",
                        data:{message_id:message_id},
                        
                        success:function(data){
                            alert(data);
                            window.reload();
                        }
                    })
                }else{
                    return false;
                }
            });

            $(document).on("click", ".engaged", function(e){
                e.preventDefault();
                var applicationId = $(this).attr("href");
                

                $("#detailsModal").modal("show");

                $.ajax({
                    url:"clients/processor/getEngamentDetails",
                    method:"post",
                    data:{applicationId:applicationId},
                    
                    success:function(data){
                        $("#messageSpan").html(data);
                    }
                })
            })
    
        })
    </script>

</body>

</html>