<?php include("addons/body_top.php")?>
    <div class="container-fluid">
        <div class="card card-solid mb-5">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 bg-light border p-4 mb-4">
                        <h4>Search Criteria</h4>
                        <form method="get" id="searchForm">
                            <div class="form-group mb-3">
                                <label class="mb-2">Province</label>
                                <select class="form-control" name="province" id="province" onchange="searchByProvince(this.value)">
                                    <option value="">All Provinces</option>
                                        <?php 
                                            $query = $connect->prepare("SELECT * FROM `provinces`");
                                            $query->execute();
                                            foreach ($query->fetchAll() as $row) {
                                                extract($row);
                                            
                                        ?>
                                    <option value="<?php echo $id;?>"><?php echo $name;?></option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="mb-2">Town</label>
                                <select class="form-control" name="town" id="town" onchange="searchByTown(this.value)" >
                                    <option value="">Select City</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-9 mb-4">
                        
                        <div id="lawyersFind"></div>
                    </div>    
                </div>
            </div>
        </div>
    
        <!-- Fees Modal -->
        <div class="modal fade" id="consultModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Open consultation</h5>
                        <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">x</button>
                    </div>
                    <div class="modal-body">
                        
                        <form method="POST">
                            <div id="consultation"></div>
                            <input type="hidden" name="currency" id="currency" >
                            <input type="hidden" name="consultation_fee" id="consultation_fee" >
                            <!-- <input type="hidden" name="consultation_fee" id="consultation_fee" > -->
                            <button type="button" id="start-payment-button" class="btn btn-outline-dark m-1 py-2 px-4 rounded-pill" onclick="makePayment()">Pay Now</button>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <!-- <button type="button" class="btn btn-primary" id="sendBtn">Send Message</button> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    

    <?php include("addons/body_bottom.php")?> 
    <script>
        $(document).on("click", ".clickable", function (e) {
            const clickable = $(this).data("id");
            window.location = 'lawyer-profile/'+btoa(clickable);
        })

        $(document).on("click", ".consult", function(e){
            e.preventDefault();
            var lawyer_id = $(this).attr('href');
            $("#consultModal").modal("show");
        })

        function lawyersFind(){
            var find = 'lawyersFind';
            $.ajax({
                url: 'clients/processor/lawyersFind',
                method:'post',
                data:{find:find},
                success:function(data){
                    $("#lawyersFind").html(data);
                }
            })
        }
        lawyersFind();

        function searchByProvince(province){
            if(province !== ""){
                $.ajax({
                    url: 'clients/processor/findByProvince',
                    method:'post',
                    data:{province:province},
                    success:function(data){
                        $("#lawyersFind").html(data);
                    }
                })
                $.ajax({
                    url:"processor/fetchTowns",
                    method:"post",
                    data:{province:province},
                    success:function(data){
                        $("#town").html(data);
                    }
                })
            }else{
                lawyersFind();
            }
        }

        function searchByTown(town){
            if(town !== ""){
                $.ajax({
                    url: 'clients/processor/findByTown',
                    method:'post',
                    data:{town:town},
                    success:function(data){
                        $("#lawyersFind").html(data);
                    }
                })
                
            }else{
                lawyersFind();
            }
        }
    </script>
    
    <script src="https://checkout.flutterwave.com/v3.js"></script>

    <script>
        $(document).on("click", ".consult", function(e){
            e.preventDefault();
            var currency = $(this).data('currency');
            var consultation = $(this).data('consultation');
            document.getElementById('currency').value = currency;
            document.getElementById('consultation_fee').value = consultation;
            document.getElementById('consultation').innerHTML = "<h4><strong>"+currency+" "+consultation+"</strong></h4>";
            if(confirm("The lawyer requires you to pay consultation fee of: "+currency+" "+consultation )){
                $("#consultModal").modal("show");
            }else{
                // $("#consultModal").modal("close");
                return false;
            }
            
        })
        function makePayment() {
            var currency = document.getElementById('currency').value;
            var amount = document.getElementById('consultation_fee').value;
            const tx_ref = Math.random().toString(36).substring(2, 17);
            const email = '<?php echo $_SESSION['userEmail']?>';
            const phone = '<?php echo $_SESSION['phonenumber']?>';
            const name = '<?php echo getUserByPhoneNumber($connect, $_SESSION['phonenumber'])?>';
            const consumer_id = phone;
            const consumer_mac = Math.random().toString(36).substring(2, 17);
            FlutterwaveCheckout({
                public_key: "FLWPUBK-2cc15d3e7d92a0ce012bdabbf548afd5-X",
                tx_ref: tx_ref,
                amount: amount,
                currency: currency,
                payment_options: "",
                redirect_url: "http://localhost/milatu.co/clients/consultation-payment",
                meta: {
                    consumer_id: consumer_id,
                    consumer_mac: consumer_mac,
                },
                customer: {
                    email: email,
                    phone_number: phone,
                    name: name,
                },
                customizations: {
                    title: "Milatu.co",
                    description: "Legal consultation fees",
                    logo: "https://milatulegal.com/dist/images/MilatuIcon.png",
                },
            });
        }
    </script>

</body>

</html>