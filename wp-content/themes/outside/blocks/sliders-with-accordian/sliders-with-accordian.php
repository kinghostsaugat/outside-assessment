<?php
$heading = get_field('ot_heading');
$footer = get_field('ot_footer');
if (have_rows('ot-slider-with-accordian')) {
?>
	<!-- Slider with Accordian -->
	<section class="slider-accordion-container">
		<div class="slider-section">
			<div class="swiper-container">
				<div class="swiper-wrapper">
					<?php while (have_rows('ot-slider-with-accordian')) {
						the_row();
						$video = get_sub_field('ot_video'); ?>
						<div class="swiper-slide">
							<iframe class="video-frame" src="<?= $video; ?>" frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<div class="accordion-section">
			<?php if (!empty($heading)) { ?>
				<div class="sectionheading">
					<h1><?= $heading; ?></h1>
				</div>
			<?php } ?>
			<div class="accordion">
				<?php
				$count = 0;
				while (have_rows('ot-slider-with-accordian')) {
					the_row();
					$acc_title = get_sub_field('accordian_title');
					$acc_desc = get_sub_field('ot_accordian_content');
				?>
					<div class="accordion-item" data-slide-index="<?= $count ?>">
						<div class="progress-bar"></div>
						<h3 class="accordion-title"><?php echo $acc_title; ?></h3>
						<div class="accordion-content">
							<?php echo wpautop($acc_desc); ?>
						</div>
					</div>
				<?php $count++;
				}  ?>
			</div>
			<?php if (!empty($footer)) { ?>
				<div class="sectionfooter">
					<?= wpautop($footer); ?>
				</div>
			<?php } ?>
		</div>
	</section>
	<!-- /Slider with Accordian -->
<?php } ?>