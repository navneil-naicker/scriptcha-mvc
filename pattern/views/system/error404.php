<?php view('header'); ?>
<div id="grumpy-cat-placeholder">
    <img class="img-circle" src="<?php echo public_url('images/Grumpy-Cat-920x584.jpg'); ?>" alt="">
    <h3>Error 404!</h3>
    <p>Sorry, the page you are looking for could not be found.</p>
    <p><a href="<?php echo base_url(); ?>" class="btn btn-danger"><i class="fa fa-home"></i> Go Home</a></p>
</div>
<?php view('footer'); ?>
