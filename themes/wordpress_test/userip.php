<?php /* Template Name: User Ip */ ?>

<?php get_header(); ?>
<?php $user_ip = $_SERVER['REMOTE_ADDR'];  
   echo $user_ip;
?>
<?php get_footer();?>