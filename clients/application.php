<?php include("addons/body_top.php")?>
    <style>
    .letter {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        padding: 30px;
        margin: 20px;
        font-family: Arial, sans-serif;
        font-size: 16px;
        line-height: 1.5;
    }
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .header h1 {
        font-size: 20px;
        margin: 0;
    }
    .header h2 {
        font-size: 16px;
        margin: 0;
        color: #666;
    }
    .body {
        margin-top: 20px;
    }
    @media (max-width: 600px) {
        .letter {
            box-shadow: none;
            padding: 15px;
        }
        .header h1 {
            font-size: 18px;
        }
        .header h2 {
            font-size: 14px;
        }
    }
    </style>

    <div class="container-fluid">
        <?php
            if (isset($_GET['apid'])) {
                $apid = preg_replace("#[^0-9+]#", "", $_GET['apid']);
    
            }
            $update = $connect->prepare("UPDATE table_applications SET client_opened = client_opened + 1 WHERE id = ? ");
            $update->execute([$apid]);

            $query = $connect->prepare("SELECT * FROM table_applications WHERE id = ? ");
            $query->execute([$apid]);
            $row = $query->fetch();
            extract($row);
                

            if($offer_job == '0'){
                $btn = '<a href="'.$id.'" class="btn btn-primary offer_job" data-client_id="'.$client_id.'"  data-lawyer_id="'.$lawyer_id.'">Accept and Offer Job</a>';
            }else{
                $btn = '<a href="'.$id.'" class="btn btn-primary revoke_job" data-client_id="'.$client_id.'"  data-lawyer_id="'.$lawyer_id.'">Revoke Offer</a>';
            }   
        ?>               
        <div class="row">
            <div class="col-md-6">
                <div class="letter">
                    <div class="header">
                        <h1>Dear <?php echo getUserByPhoneNumber($connect, $client_id)?>,</h1>
                        
                    </div>
                    <div class="body">
                        <p><?php echo htmlspecialchars_decode($introduction) ?></p>
                        <p><?php echo htmlspecialchars_decode($costing) ?></p>
                        
                        <p>Thank you for considering my offer of legal representation. I look forward to the opportunity to work with you and help you achieve a favorable resolution to your case.</p>
                        <p>Sincerely,<br><?php echo getUserByPhoneNumber($connect, $lawyer_id)?></p>
                    </div>
                </div>
                <div class="card-footer">
                    <?php echo $btn?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="letter">
                <div class="header"><h1>Lawyers Profile</h1></div>
                <div class="card-body"><a href="clients/lawyerprofile?lawyer-apid=<?php echo base64_encode($lawyer_id)?>" target="_blank"><?php echo getUserByPhoneNumber($connect, $lawyer_id)?></a></div>
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
            $(document).on("click", ".offer_job", function(e){
                e.preventDefault();
                var job_id = $(this).attr("href");
                var client_id = $(this).data("client_id");
                var lawyer_id = $(this).data("lawyer_id");
                if(confirm("You wish to accept this legal representation and offer a job")){
                    $.ajax({
                        url:"clients/processor/jobActions",
                        method:"post",
                        data:{job_id:job_id, client_id:client_id, lawyer_id:lawyer_id},
                        
                        success:function(data){
                            alert(data);
                            location.reload();
                        }
                    })
                }else{
                    return false;
                }
            });
        })
    </script>

</body>

</html>