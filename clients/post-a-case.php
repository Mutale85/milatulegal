<?php include("addons/body_top.php")?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card border p-5">
                    <h2 class="text-centers">Post your legal needs</h2>
                    <p class="text-centers">What you post will always be anonymous</p>
                    <div class="border-bottom mb-5"></div>
                    <?php 
                        $query = $connect->prepare("SELECT * FROM table_members WHERE phonenumber = ?");
                        $query->execute([$_SESSION['phonenumber']]);
                        $row = $query->fetch();
                        extract($row);
                        
                    ?>
                    <form method="post" class="row" id="legalRequestForm">
                        <label class="lable col-md-6 mb-3">Names</label>
                        <div class="form-group col-md-6 mb-3">
                            <div class="input-group">
                                <input type="text" name="firstname" id="firstname" class="form-control" value="<?php echo $firstname?>" readonly>
                                <input type="text" name="lastname" id="lastname" class="form-control" value="<?php echo $lastname?>" readonly>
                            </div>
                        </div>

                        <label class="lable col-md-6 mb-3">Email</label>
                        <div class="form-group col-md-6 mb-3">
                            <input type="text" name="email" id="email" class="form-control" value="<?php echo $email?>" readonly>
                            <small><i>Enter your email, it wont be included in the post</i></small>
                        </div>
                        <label class="lable col-md-6 mb-3">Phone number</label>
                        <div class="form-group col-md-6 mb-3">
                            <input type="text" name="phonenumber" id="phonenumber" class="form-control" value="<?php echo $phonenumber?>" readonly>
                        </div>
                        <label class="lable col-md-6 mb-3">Choose Lawyer</label>
                        <div class="form-group col-md-6 mb-3">
                            
                            <select class="form-control" name="lawyer_type" id="lawyer_type">
                                <option value="">Select lawyer's expertise</option>
                                <option value="Family Law">Family Law</option>
                                <option value="Business Law">Business Law</option>
                                <option value="Labor and Employment">Labor and Employment Law</option>
                                <option value="Civil Rights">Civil Rights</option>
                                <option value="Criminal Law">Criminal Law</option>
                                <option value="Immigration Law">Immigration Law</option>
                            </select>
                        </div>
                        <label class="lable col-md-6 mb-3">Case or Issue Name</label>
                        <div class="form-group col-md-6 mb-3">
                            <input type="text" name="case_title" id="case_title" class="form-control" placeholder="Need help with Property issues">
                        </div>

                        <label class="lable col-md-6 mb-3">Description of Issue</label>
                        <div class="form-group col-md-6 mb-3">
                            <textarea class="form-control" rows="5" name="description" id="description" placeholder="Give a general description on your case or issue."></textarea>
                            <!-- <small>NOTE: <i>Don't include names or documents, you will do that later.</i></small> -->
                        </div>

                        <label class="lable col-md-6 mb-3">Choose Location</label>
                        <div class="form-group col-md-6 mb-3">
                            <div class="input-group">
                                <select class="form-control" name="province" id="province" required>
                                <option value="">Select Province</option>
                                <?php 
                                    $query = $connect->prepare("SELECT * FROM `provinces`");
                                    $query->execute();
                                    foreach ($query->fetchAll() as $row) {
                                        extract($row);
                                    
                                ?>
                                
                                <option value="<?php echo $id;?>"><?php echo $name;?></option>
                                <?php }?>
                            </select>
                            <select class="form-control" name="town" id="town" required>
                                
                            </select>
                            </div>
                        </div>

                        <label class="lable col-md-6 mb-3">How would you prefer to pay?</label>
                        <div class="form-group col-md-6 mb-3">
                            <select class="form-control" name="payment_mode" id="payment_mode" required>
                                <option value="">Payment Mode</option>
                                <option value="Hourly"> Hourly - Pay by the Hour</option>
                                <option value="Fixed">Fixed - Pay by the project</option>
                                <option value="Pro-bono">Pro-bono - I cant afford a lawyer</option>
                            </select>
                        </div>
                        <div class="col-md-6 mt-5"></div>
                        <div class="col-md-6 mt-5 mb-5">
                            <button class="btn btn-secondary" id="submitBtn" type="submit">Post Your Case</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php include("addons/body_bottom.php")?>
    <script>
        $(function(){
            $("#province").change(function(e){
                var province = $(this).val();
                $.ajax({
                    url:"parsers/fetchTowns",
                    method:"post",
                    data:{province:province},
                    success:function(data){
                        $("#town").html(data);
                    }
                })
            })
        })

        $(document).ready(function(){
            $("#legalRequestForm").submit(function(e){
                e.preventDefault();
                var url = 'clients/processor/postlegalRequest';
                $.ajax({
                    url:url,
                    method:"POST",
                    data:$(this).serialize(),
                    beforeSend:function(){
                        $("#submitBtn").html("<span class='spinner-grow spinner-grow-sm'></span> Please Wait...");
                    },
                    success:function(data){
                        successToast(data);
                        $("#legalRequestForm")[0].reset();
                        $("#submitBtn").html("Post Your Case");
                        
                    }
                })
            })
        })
    </script>
</body>

</html>