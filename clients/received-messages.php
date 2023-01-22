<?php include("addons/body_top.php")?>
    <style>
        a[title] {
            position: relative;
            display: inline-block;
        }

        a[title]:before {
            content: attr(title);
            position: absolute;
            left: 0;
            top: 100%;
            white-space: nowrap;
            background-color: #000;
            color: #fff;
            padding: 5px;
            border-radius: 5px;
            visibility: hidden;
            opacity: 0;
            transition: all 0.5s ease;
        }

        a[title]:hover:before,
        a[title]:focus:before {
            visibility: visible;
            opacity: 1;
        }

    </style>
    


<div class="container-fluid">
    <div class="row">
        <!-- <div class="col-md-3">
          <a href="compose.html" class="btn btn-primary btn-block mb-3">Compose</a>

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Folders</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0">
              <ul class="nav nav-pills flex-column">
                <li class="nav-item active">
                  <a href="#" class="nav-link">
                    <i class="fas fa-inbox"></i> Inbox
                    <span class="badge bg-primary float-right">12</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-envelope"></i> Sent
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-file-alt"></i> Drafts
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="fas fa-filter"></i> Junk
                    <span class="badge bg-warning float-right">65</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-trash-alt"></i> Trash
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Labels</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0">
              <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle text-danger"></i>
                    Important
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle text-warning"></i> Promotions
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle text-primary"></i>
                    Social
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div> -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Inbox</h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            
                            
                        </div>
                    </div>
                </div>
                
                
                <div class="card-body ">
                    <!-- <div class="mailbox-controls">
                        <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i>
                        </button>
                        <div class="btn-group">
                        <button type="button" class="btn btn-default btn-sm">
                            <i class="far fa-trash-alt"></i>
                        </button>
                        <button type="button" class="btn btn-default btn-sm">
                            <i class="fas fa-reply"></i>
                        </button>
                        <button type="button" class="btn btn-default btn-sm">
                            <i class="fas fa-share"></i>
                        </button>
                        </div>
                        <button type="button" class="btn btn-default btn-sm">
                        <i class="fas fa-sync-alt"></i>
                        </button>
                        
                    </div> -->
                    <div class="table-responsive mailbox-messages">
                        <table class="table table-hover table-striped" id="messageTable">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            
                                <?php

                                    $query = $connect->prepare("SELECT * FROM table_messages WHERE receiver_id = ? AND receiver_delete = '0' ");
                                    $query->execute([$_SESSION['phonenumber']]);
                                    foreach ($query->fetchAll() as $row) {
                                        extract($row);
                                        if($message_status == 0){
                                            $message_status = '<span class="btn btn-warning"><i class="bi bi-envelope"></i></span>  <a href="'.$id.'" class="btn btn-primary bt-sm see_message"> Read</a> ';
                                        }else{
                                            $message_status = '<span class="text-success btn btn-success"><i class="bi bi-envelope-open"></i></span>  <a href="'.$id.'" class="btn btn-primary bt-sm see_message"> Read</a> ';
                                        }
                                ?>
                                
                                <tr>
                                    <td>
                                        <div class="icheck-primary">
                                            <input type="checkbox" value="" id="check<?php echo $id?>">
                                            <label for="check<?php echo $id?>"></label>
                                        </div>
                                    </td>
                                    <td class="mailbox-name"><a href="read?mid=<?php echo $id?>"><?php echo getUserByPhoneNumber($connect, $sender_id)?></a></td>
                                    <td class="mailbox-subject"><b><?php echo $subject?></b></td>
                                    <td class="mailbox-attachment"><a href="<?php echo $id?>" class="btn btn-danger btn-sm delete_message" title="Delete message"><i class="bi bi-trash"></i></a></td>
                                    <td class="mailbox-date"><?php echo time_ago_check($message_date)?></td>
                                </tr> 
                                <?php 
                                    }

                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- Message Modal -->
                    <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Message Potential Client</h5>
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
                    <!-- End of Message Modal -->
                </div>
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

            $(document).on("click", ".see_message", function(e){
                e.preventDefault();
                var message_id = $(this).attr("href");
                

                $("#messageModal").modal("show");

                $.ajax({
                    url:"clients/processor/seeMessage",
                    method:"post",
                    data:{message_id:message_id},
                    
                    success:function(data){
                        $("#messageSpan").html(data);
                    }
                })
            })
    
        })
    </script>
    <script>
        $(function () {
            //Enable check and uncheck all functionality
            $('.checkbox-toggle').click(function () {
            var clicks = $(this).data('clicks')
            if (clicks) {
                //Uncheck all checkboxes
                $('.mailbox-messages input[type=\'checkbox\']').prop('checked', false)
                $('.checkbox-toggle .far.fa-check-square').removeClass('fa-check-square').addClass('fa-square')
            } else {
                //Check all checkboxes
                $('.mailbox-messages input[type=\'checkbox\']').prop('checked', true)
                $('.checkbox-toggle .far.fa-square').removeClass('fa-square').addClass('fa-check-square')
            }
            $(this).data('clicks', !clicks)
            })

            //Handle starring for font awesome
            $('.mailbox-star').click(function (e) {
            e.preventDefault()
            //detect type
            var $this = $(this).find('a > i')
            var fa    = $this.hasClass('fa')

            //Switch states
            if (fa) {
                $this.toggleClass('fa-star')
                $this.toggleClass('fa-star-o')
            }
            })
        })
    </script>
</body>

</html>