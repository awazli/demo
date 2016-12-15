<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <title>CiCrud</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-datepicker.min.css">
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <h2>Demo form</h2>
    <div class="col-sm-6">
        <form name="demoForm" id="demoForm" action="<?php echo base_url(); ?>user/update/<?php echo $data->id;?>" method="post"
              enctype="multipart/form-data">
            <div class="form-group">
                <input type="text" value="<?php echo $data->name;?>" class="form-control" name="name" id="name" placeholder="Enter name" required>
            </div>
            <div class="form-group">
                <input type="radio" name="gender" id="gender" value="male" <?php if($data->gender == "male"){echo "checked";}?> required>Male
                <input type="radio" name="gender" id="gender" value="female" <?php if($data->gender == "female"){echo "checked";}?> required>Female
            </div>
            <div class="form-group">
                <input type="text" value="<?php echo $data->birthdate;?>" class="form-control" name="birthdate" id="birthdate" placeholder="dd/mm/yyyy"
                       required>
            </div>
            <div class="form-group">
                <select name="country_id" id="country_id" class="form-control">
                    <option value="">Select Country</option>
                    <?php foreach ($country as $row) { ?>
                        <option value="<?php echo $row->id; ?>" <?php if(isset($data->country_id) && ($data->country_id == $row->id)){echo "selected";}?>><?php echo $row->name; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <select name="state_id" id="state_id" class="form-control">
                    <option value="">Select State</option>
                    <?php foreach ($state as $row) { ?>
                        <option value="<?php echo $row->id; ?>" <?php if(isset($data->state_id) && ($data->state_id == $row->id)){echo "selected";}?>><?php echo $row->name; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <select name="city_id" id="city_id" class="form-control">
                    <option value="">Select City</option>
                    <?php foreach ($city as $row) { ?>
                        <option value="<?php echo $row->id; ?>" <?php if(isset($data->city_id) && ($data->city_id == $row->id)){echo "selected";}?>><?php echo $row->name; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <textarea type="text" class="form-control" name="address" id="address" col="10" row="5"
                           placeholder="Enter address"><?php echo isset($data->address)?$data->address:"";?></textarea>
            </div>
            <div class="form-group">
                <img src="<?php echo base_url();?>uploads/<?php echo isset($data->profile)?$data->profile:"";?>" height="30" width=50">
                <input type="file" class="form-control" name="profile" id="profile">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" value="<?php echo isset($data->email)?$data->email:"";?>" name="email" id="email" placeholder="Enter email" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="username" value="<?php echo isset($data->username)?$data->username:"";?>" id="username" placeholder="Enter username"
                       required>
            </div>
            <div class="checkbox">
                <input type="submit" id="submit" value="Submit" class="btn btn-default">
            </div>
        </form>
    </div>
</div>

</body>
</html>
<script>
    $(document).ready(function () {
        $('#birthdate').datepicker({
        });
        $("#country_id").on('change', function () {
            var country_id = $(this).val();

            if (country_id != "") {
                $("#state_id").attr("disabled", false);
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url();?>user/getcitystate",
                    data: {'id': country_id, 'table': "state"},
                    success: function (data) {
                        $("#state_id").html(data);
                    }
                });
            }
            else{
                $("#state_id").attr("disabled", true);
                $("#city_id").attr("disabled", true);
            }
        });

        $("#state_id").on('change', function () {
            var state_id = $(this).val();

            if (state_id != "") {
                $("#city_id").attr("disabled", false);
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url();?>user/getcitystate",
                    data: {'id': state_id, 'table': "city"},
                    success: function (data) {
                        $("#city_id").html(data);
                    }
                });
            }
            else{
                $("#city_id").attr("disabled", true);
            }
        });
    });
</script>

