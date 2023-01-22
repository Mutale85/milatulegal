<?php include("addons/body_top.php")?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Report Lawyer</div>
                    <form method="post" id="reportLawyer">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">What happened?</label>
                                <textarea class="form-control" rows="5" cols="3" name="report" id="report" placeholder="Give us details of what happened"></textarea>
                            </div>
                            
                            <div class="form-group">
                                <label for="exampleInputFile">Attach Document</label>
                                <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                                </div>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">My submission is truthful</label>
                            </div>
                        </div>
                        
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php include("addons/body_bottom.php")?> 


</body>

</html>