<?php
    header("Content-type: text/css");
    
    $border = '1px solid black';
    $padding = '5px';
    $display = 'table';
    $labeldisplay = 'table-row';
?>

 table{
        border: <?php echo $border; ?>;
        padding: <?php echo $padding; ?>;
      }
       th{
        border: <?php echo $border; ?>;
        padding: <?php echo $padding; ?>;
      }
       td{
        border: <?php echo $border; ?>;
        padding: <?php echo $padding; ?>;
      }
 form{
        display: <?php echo $display; ?>;
 }
  label{
        display: <?php echo $labeldisplay; ?>;
 }