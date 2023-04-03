<h3>Your file was successfully uploaded!</h3>

<?php echo $error;?>
<ul>
<?php foreach ($upload_data as $item => $value):?>
<li><?php echo $item;?>: <?php echo $value;?></li>
<?php endforeach; ?>
</ul>


