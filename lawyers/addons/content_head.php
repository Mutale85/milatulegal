<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h4 class="m-0 h5"> <span id="time"></span></h4>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="clients/">Home</a></li>
                <li class="breadcrumb-item active">Dashboard v2</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<script>
    var currentTime = new Date();
    var currentHour = currentTime.getHours();
    var username = "<?php echo $_SESSION['firstname'];?>";
    var time = document.getElementById('time');
    if (currentHour < 12) {
        time.innerText = "Good morning! " + username;
    } else if (currentHour < 17) {
    time.innerText = "Good afternoon! " + username;
    } else {
    time.innerText = "Good evening! " + username;
    }

</script>