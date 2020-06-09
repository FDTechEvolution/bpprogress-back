<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title><?=PAGE_TITLE?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- App css -->
        <?= $this->Html->css('assets/css/bootstrap.min.css')?>
        <?= $this->Html->css('assets/css/icons.min.css')?>
        <?= $this->Html->css('assets/css/app.min.css')?>

    </head>

    <body>

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <?= $this->fetch('content')?>
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->


        <footer class="footer footer-alt">
            2016 - 2019 &copy; Minton theme by <a href="" class="text-muted">Coderthemes</a> 
        </footer>

        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>

    </body>
</html>