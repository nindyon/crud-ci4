<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    
</head>
<body>
 
    <div class="container mt-5 mb-5 text-center">
        <h4>Tutorial CRUD Menggunakan Codeigniter 4 - Ilmu Coding</h4>
    </div>
    <div class="container">
        <?php
        if(!empty(session()->getFlashdata('success'))){ ?>
 
        <div class="alert alert-success">
            <?php echo session()->getFlashdata('success');?>
        </div>
             
        <?php } ?>
        <?php if(!empty(session()->getFlashdata('info'))){ ?>
 
        <div class="alert alert-info">
            <?php echo session()->getFlashdata('info');?>
        </div>
             
        <?php } ?>
 
        <?php if(!empty(session()->getFlashdata('warning'))){ ?>
 
        <div class="alert alert-warning">
            <?php echo session()->getFlashdata('warning');?>
        </div>
             
        <?php } ?>
    </div>
    <div class="container">
        <a href="<?php echo base_url('product/create'); ?>" class="btn btn-success float-right mb-3">Tambah Produk</a>
        <div class="table-responsive">
            <table id="myTable" class="table table-bordered">
                <thead>
                    <th>No</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    foreach($product as $key) { ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $key->product_name; ?></td>
                        <td><?php echo $key->product_description; ?></td>
                        <td>
                            <div class="btn-group">
                                <a href="<?php echo base_url('product/edit/'.$key->product_id); ?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                <a href="<?php echo base_url('product/delete/'.$key->product_id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus produk <?php echo $key->product_name; ?> ini?')"><i class="fas fa-trash-alt"></i></a>
                            </div>
                        </td>
                    </tr>
                    <?php $no++; } ?>
                </tbody>
            </table>
        </div>
    </div>
     
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js" ></script>
</body>
</html> 
<!-- <script>
    $(document).ready( function () {
    $('#myTable').DataTable();
} );
</script> -->
<script type="text/javascript" language="javascript" >
 $(document).ready(function() {
 var dataTable = $('#myTable').DataTable( {
 "processing": true,
 "serverSide": true,
 "ajax":{
 url :"data_server.php",
 type: "post",
 error: function(){
 $(".myTable-error").html("");
 $("#myTable").append('<tbody class="myTable-error"><tr><th colspan="3">Tidak ada data untuk ditampilkan</th></tr></tbody>');
 $("#myTable-error-proses").css("display","none");
 
 }
 }
 } );
 } );
 </script>
 <style>
 div.container {
     margin: 0 auto;
     max-width:760px;
 }
 div.header {
     margin: 100px auto;
     line-height:30px;
     max-width:760px;
 }
 body {
     background: #f7f7f7;
     color: #333;
     font: 90%/1.45em "Helvetica Neue",HelveticaNeue,Verdana,Arial,Helvetica,sans-serif;
 }
 </style>