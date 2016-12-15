<!DOCTYPE html>
<html lang="en">
<head>
  <title>List</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
      <script src="<?php echo base_url(); ?>assets/js/jquery-3.1.1.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Demo Table</h2>
  <h2><a class="btn btn-success pull-right" href="<?php echo base_url();?>user/add">Add</a></h2>
    <table class="table">
    <thead>
      <tr>
        <th></th>
        <th>Name</th>
        <th>Gender</th>
        <th>Birthdate</th>
        <th>Email</th>
        <th>Username</th>
        <th>Address</th>
        <th>Country</th>
        <th>state</th>
        <th>city</th>

      </tr>
    </thead>
    <tbody>
    <?php foreach($user as $row){?>
      <tr>
        <td><img src="<?php echo base_url();?>uploads/<?php echo $row->profile;?>" height="30" width="50"></td>
        <td><?php echo $row->name;?></td>
        <td><?php echo $row->gender;?></td>
        <td><?php echo $row->birthdate;?></td>
        <td><?php echo $row->email;?></td>
        <td><?php echo $row->username;?></td>
        <td><?php echo $row->address;?></td>
        <td><?php echo $row->country;?></td>
        <td><?php echo $row->state;?></td>
        <td><?php echo $row->city;?></td>

        <td><a class="btn btn-primary" href="<?php echo base_url();?>user/edit/<?php echo $row->id;?>">Edit</a></td>
        <td><a class="btn btn-danger" href="<?php echo base_url();?>user/delete/<?php echo $row->id;?>">Delete</a></td>
      </tr>
      <?php }?>
    </tbody>
  </table>
</div>

</body>
</html>

