<?php include("../includes/db.php")?>
<?php include("../includes/base.php")?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php 
    include("addons/header.php");
  ?>
    <style>
        .subscriber-profile {
            width: 500px;
            margin: 0 auto;
            text-align: center;
        }

        .subscriber-name {
            font-size: 2em;
            margin-bottom: 0.5em;
        }

        .subscription-status {
            font-size: 1.5em;
            margin-bottom: 1em;
        }

        button[type="submit"] {
            background-color: green;
            color: white;
            border: none;
            padding: 0.5em 1em;
            cursor: pointer;
        }
    </style>
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
                            <div class="subscriber-profile">
                                <h1 class="subscriber-name"><?php getUserByPhoneNumber($connect, $_SESSION['phonenumber']) ?></h1>
                                <p class="subscription-status">
                                <?php
                                  // PHP code to check if the subscriber has paid
                                    $query = $connect->prepare("SELECT * FROM table_subscriptions WHERE phonenumber = ? AND payment_status = '1'");
                                    $query->execute([$_SESSION['phonenumber']]);
                                    $paid = $query->rowCount();
                                    if ($paid > 0) {
                                        echo 'You have a current subscription.';
                                    } else {
                                        echo 'Your subscription has expired. Please renew your subscription to access content.';
                                    }
                                ?>
                              </p>
                              <?php if (!$paid): ?>
                                <!-- HTML for the "pay now" button -->
                                <form action="" method="post">
                                  <input type="hidden" name="amount" value="<?php echo $amountDue; ?>">
                                  <button type="submit">Pay Now</button>
                                </form>
                              <?php endif; ?>
                            </div>

                        </div>
                    </div>

                </div>
            </section>
        </div>
        <?php include("addons/footer.php")?>
    
    </div>
    <?php include("addons/footerjs.php")?>
</body>

</html>