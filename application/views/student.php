<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> | NMSSVNC COLLGE</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script defer src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script defer type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.js"></script>
  	<script defer src="<?= base_url() ?>public/template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script defer type="text/javascript" src="<?= base_url() ?>public/javascripts/<?= $js?>.js"></script>
    <style type="text/css">
      .error {
        color: red;
      }
    </style>
</head>
<body>


<?php
$this->load->view('students/'.$main_content);
?>

  <script type="text/javascript">

    var token = '<?php echo $this->security->get_csrf_hash(); ?>';
  </script>
</body>
</html>