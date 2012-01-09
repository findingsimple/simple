<?php 
/**
Template Page for the gallery overview

Follow variables are useable :

	$gallery     : Contain all about the gallery
	$images      : Contain all images, path, title
	$pagination  : Contain the pagination content

 You can check the content when you insert the tag <?php var_dump($variable) ?>
 If you would like to show the timestamp of the image ,you can use <?php echo $exif['created_timestamp'] ?>
**/
?>
<?php if (!defined ('ABSPATH')) die ('No direct access allowed'); ?><?php if (!empty ($gallery)) : ?>

<ul class="cs-gallery-<?php echo $gallery->ID ?> jcarousel-skin-tango" id="cs-gallery">

	<!-- Thumbnails -->
	<?php foreach ($images as $image) : ?>
		<li><img title="<?php echo $image->alttext ?>" alt="<?php echo $image->alttext ?>" src="<?php echo $image->imageURL ?>" <?php echo $image->size ?> /></li>	
 		<!-- <?php var_dump($images); ?> -->
 	<?php endforeach; ?>
 	
</ul>

<?php endif; ?>
