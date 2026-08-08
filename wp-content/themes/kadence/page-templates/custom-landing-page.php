<?php

/**
 * Template Name: Custom Landing Page
 *
 * Template for displaying a custom landing page using ACF Flexible Content.
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;


get_header();
?>

<main id="landing-page-content">
	<?php
	if (have_rows('sections')) {
		while (have_rows('sections')) {
			the_row();

			// ==========================================
			// 1. Hero Section
			// ==========================================
			if (get_row_layout() == 'hero_section') {
				$bg_id = get_sub_field('background_image');
				$subtitle = get_sub_field('subtitle');
				$title = get_sub_field('title');
				$desc = get_sub_field('description');
	?>
				<section class="landing-section-hero">
					<?php
					if ($bg_id) {
						echo wp_get_attachment_image($bg_id, 'full', false, ['class' => 'hero-bg-img']);
					} else {
						echo '<img class="hero-bg-img" src="https://picsum.photos/1920/800" alt="Hero Background Placeholder">';
					}
					?>
					<div class="hero-container">
						<div class="hero-content">
							<?php if ($subtitle) : ?>
								<h3 class="hero-subtitle"><?php echo wp_kses_post($subtitle); ?></h3>
							<?php endif; ?>
							<?php if ($title) : ?>
								<h1 class="hero-title"><?php echo wp_kses_post($title); ?></h1>
							<?php endif; ?>
							<?php if ($desc) : ?>
								<div class="hero-desc">
									<?php echo wp_kses_post($desc); ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</section>
			<?php
			}

			// ==========================================
			// 2. Process Overview
			// ==========================================
			elseif (get_row_layout() == 'process_overview') {
				$title = get_sub_field('title');
				$desc_top = get_sub_field('description_top');
				$desc_bottom = get_sub_field('description_bottom');
			?>
				<section class="landing-section-process">
					<div class="landing-container">
						<?php if ($title) : ?>
							<h2 class="process-title"><?php echo wp_kses_post($title); ?></h2>
						<?php endif; ?>
						<div class="process-divider"></div>

						<?php if ($desc_top) : ?>
							<div class="process-desc">
								<?php echo wp_kses_post($desc_top); ?>
							</div>
						<?php endif; ?>

						<?php if (have_rows('process_items')) : ?>
							<div class="process-grid">
								<?php while (have_rows('process_items')) : the_row();
									$img_id = get_sub_field('image');
									$pi_title = get_sub_field('title');
									$pi_desc = get_sub_field('description');
								?>
									<div class="process-item">
										<?php echo $img_id ? wp_get_attachment_image($img_id, 'medium') : ''; ?>
										<div class="item-content">
											<?php if ($pi_title) : ?>
												<h4 class="item-title"><?php echo wp_kses_post($pi_title); ?></h4>
											<?php endif; ?>
											<?php if ($pi_desc) : ?>
												<p class="item-desc"><?php echo wp_kses_post($pi_desc); ?></p>
											<?php endif; ?>
										</div>
									</div>
								<?php endwhile; ?>
							</div>
						<?php endif; ?>

						<?php if ($desc_bottom) : ?>
							<div class="process-desc-bottom">
								<?php echo wp_kses_post($desc_bottom); ?>
							</div>
						<?php endif; ?>
					</div>
				</section>
			<?php
			}

			// ==========================================
			// 3. Capabilities
			// ==========================================
			elseif (get_row_layout() == 'capabilities') {
				$title = get_sub_field('title');
			?>
				<section class="landing-section-capabilities">
					<div class="landing-container">
						<div class="cap-header">
							<?php if ($title) : ?>
								<h2 class="cap-title"><?php echo wp_kses_post($title); ?></h2>
							<?php endif; ?>
							<div class="cap-divider"></div>
						</div>

						<div class="cap-row">
							<!-- Sidebar -->
							<div class="cap-sidebar">
								<div class="cap-sidebar-inner">
									<?php if (have_rows('sidebar_list')) : ?>
										<div class="cap-list">
											<?php while (have_rows('sidebar_list')) : the_row(); ?>
												<div class="cap-list-item">
													<span class="cap-icon">
														<svg width="18" height="14" viewBox="0 0 18 14" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path d="M6.00016 11.17L1.83016 7L0.410156 8.41L6.00016 14L18.0002 2L16.5902 0.589996L6.00016 11.17Z" fill="#0399FF" />
														</svg>
													</span>
													<span><?php echo esc_html(get_sub_field('text')); ?></span>
												</div>
											<?php endwhile; ?>
										</div>
									<?php endif; ?>
								</div>
							</div>

							<!-- Content Boxes -->
							<div class="cap-content">
								<?php if (have_rows('boxes')) : ?>
									<?php while (have_rows('boxes')) : the_row();
										$box_title = get_sub_field('title');
										$desc_top = get_sub_field('description_top');
										$img_id = get_sub_field('image');
										$layout = get_sub_field('layout_style');
										$desc_bottom = get_sub_field('description_bottom');
									?>
										<div class="cap-box">
											<?php if ($box_title) : ?>
												<h3 class="box-title"><?php echo wp_kses_post($box_title); ?></h3>
											<?php endif; ?>

											<?php if ($desc_top) : ?>
												<div class="box-desc">
													<?php echo wp_kses_post($desc_top); ?>
												</div>
											<?php endif; ?>

											<?php
											// Handle Layout style
											if ($layout == 'full_width') {
												if ($img_id) {
													echo wp_get_attachment_image($img_id, 'large', false, ['class' => 'box-img-full']);
												}
											} else if ($layout == 'top_left' || $layout == 'bottom_right') {
												$bg_class = ($layout == 'top_left') ? 'bg-top-left' : 'bg-bottom-right';
											?>
												<div class="img-with-bg <?php echo esc_attr($bg_class); ?>">
													<div class="bg-shape"></div>
													<?php if ($img_id) {
														echo wp_get_attachment_image($img_id, 'large');
													} ?>
												</div>
											<?php
											}
											?>

											<?php if ($desc_bottom) : ?>
												<div class="box-desc mt-20">
													<?php echo wp_kses_post($desc_bottom); ?>
												</div>
											<?php endif; ?>
										</div>
									<?php endwhile; ?>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</section>
			<?php
			}

			// ==========================================
			// 4. Value-Added Capabilities
			// ==========================================
			elseif (get_row_layout() == 'value_added') {
				$title = get_sub_field('title');
			?>
				<section class="landing-section-value-added">
					<div class="landing-container">
						<div class="va-header">
							<?php if ($title) : ?>
								<h2 class="va-title"><?php echo wp_kses_post($title); ?></h2>
							<?php endif; ?>
							<div class="va-divider"></div>
						</div>

						<?php if (have_rows('boxes')) : ?>
							<?php while (have_rows('boxes')) : the_row();
								$icon_id = get_sub_field('icon');
								$box_title = get_sub_field('title');
								$desc = get_sub_field('description');
								$has_grid = get_sub_field('has_features_grid');
							?>
								<div class="va-box">
									<div class="va-box-header">
										<?php if ($icon_id) : ?>
											<?php echo wp_get_attachment_image($icon_id, 'thumbnail', false, ['class' => 'va-icon']); ?>
										<?php endif; ?>
										<?php if ($box_title) : ?>
											<h3 class="va-box-title"><?php echo wp_kses_post($box_title); ?></h3>
										<?php endif; ?>
									</div>

									<?php if ($desc) : ?>
										<div class="va-box-desc">
											<?php echo wp_kses_post($desc); ?>
										</div>
									<?php endif; ?>

									<?php if ($has_grid && have_rows('features')) : ?>
										<div class="va-features-grid">
											<?php while (have_rows('features')) : the_row();
												$f_title = get_sub_field('title');
												$f_desc = get_sub_field('description');
												$f_img_id = get_sub_field('image');
											?>
												<div class="va-feature-item">
													<div class="va-feature-text">
														<?php if ($f_title) : ?>
															<h4 class="va-feature-title"><?php echo wp_kses_post($f_title); ?></h4>
														<?php endif; ?>
														<?php if ($f_desc) : ?>
															<p class="va-feature-desc"><?php echo wp_kses_post($f_desc); ?></p>
														<?php endif; ?>
													</div>
													<div class="va-feature-img">
														<?php if ($f_img_id) : ?>
															<?php echo wp_get_attachment_image($f_img_id, 'medium'); ?>
														<?php endif; ?>
													</div>
												</div>
											<?php endwhile; ?>
										</div>
									<?php endif; ?>
								</div>
							<?php endwhile; ?>
						<?php endif; ?>
					</div>
				</section>
			<?php
			}

			// ==========================================
			// 5. Quality Assurance
			// ==========================================
			elseif (get_row_layout() == 'quality_assurance') {
				$main_img = get_sub_field('main_image');
				$title = get_sub_field('title');
				$sub1 = get_sub_field('subtitle_1');
				$desc1 = get_sub_field('description_1');
				$sub2 = get_sub_field('subtitle_2');
				$desc2 = get_sub_field('description_2');
				$bg_img = get_sub_field('bg_image');
				$fg_img = get_sub_field('fg_image');
			?>
				<section class="landing-section-quality">
					<div class="landing-container">
						<!-- Row 1 -->
						<div class="quality-row row-1">
							<div class="quality-col-img">
								<?php if ($main_img) echo wp_get_attachment_image($main_img, 'large'); ?>
							</div>
							<div class="quality-col-text">
								<?php if ($title) : ?>
									<h2 class="quality-title"><?php echo wp_kses_post($title); ?></h2>
								<?php endif; ?>
								<div class="quality-divider"></div>

								<?php if ($sub1) : ?>
									<h3 class="quality-subtitle"><?php echo wp_kses_post($sub1); ?></h3>
								<?php endif; ?>

								<?php if ($desc1) : ?>
									<div class="quality-desc">
										<?php echo wp_kses_post($desc1); ?>
									</div>
								<?php endif; ?>
							</div>
						</div>

						<!-- Row 2 -->
						<div class="quality-row row-2">
							<div class="quality-col-text">
								<?php if ($sub2) : ?>
									<h3 class="quality-subtitle"><?php echo wp_kses_post($sub2); ?></h3>
								<?php endif; ?>

								<?php if ($desc2) : ?>
									<div class="quality-desc">
										<?php echo wp_kses_post($desc2); ?>
									</div>
								<?php endif; ?>
							</div>
							<div class="quality-col-img">
								<div class="quality-offset-wrap">
									<div class="img-bg-layer">
										<?php if ($bg_img) echo wp_get_attachment_image($bg_img, 'large'); ?>
									</div>
									<?php if ($fg_img) echo wp_get_attachment_image($fg_img, 'large', false, ['class' => 'img-fg-layer']); ?>
								</div>
							</div>
						</div>
					</div>
				</section>
			<?php
			}

			// ==========================================
			// 6. CTA Section
			// ==========================================
			elseif (get_row_layout() == 'cta_section') {
				$bg_id = get_sub_field('background_image');
				$title = get_sub_field('title');
				$desc = get_sub_field('description');
				$btn1 = get_sub_field('button_1');
				$btn2 = get_sub_field('button_2');
			?>
				<section class="landing-section-cta">
					<div class="cta-bg-layer">
						<?php
						if ($bg_id) {
							echo wp_get_attachment_image($bg_id, 'full');
						} else {
							echo '<img src="https://picsum.photos/1920/600" alt="Background Placeholder">';
						}
						?>
					</div>
					<div class="landing-container cta-content-wrapper">
						<?php if ($title) : ?>
							<h2 class="cta-title"><?php echo wp_kses_post($title); ?></h2>
						<?php endif; ?>

						<?php if ($desc) : ?>
							<div class="cta-desc">
								<?php echo wp_kses_post($desc); ?>
							</div>
						<?php endif; ?>

						<div class="cta-actions">
							<?php if ($btn1 && isset($btn1['url'])) : ?>
								<a href="<?php echo esc_url($btn1['url']); ?>" class="cta-btn btn-primary" target="<?php echo esc_attr($btn1['target'] ? $btn1['target'] : '_self'); ?>"><?php echo esc_html($btn1['title']); ?></a>
							<?php endif; ?>

							<?php if ($btn2 && isset($btn2['url'])) : ?>
								<a href="<?php echo esc_url($btn2['url']); ?>" class="cta-btn btn-secondary" target="<?php echo esc_attr($btn2['target'] ? $btn2['target'] : '_self'); ?>"><?php echo esc_html($btn2['title']); ?></a>
							<?php endif; ?>
						</div>
					</div>
				</section>
			<?php
			}

			// ==========================================
			// 7. FAQ Section
			// ==========================================
			elseif (get_row_layout() == 'faq_section') {
				$title = get_sub_field('title');
			?>
				<section class="landing-section-faq">
					<div class="landing-container">
						<div class="faq-header">
							<?php if ($title) : ?>
								<h2 class="faq-title"><?php echo wp_kses_post($title); ?></h2>
							<?php endif; ?>
							<div class="faq-divider"></div>
						</div>

						<?php if (have_rows('faqs')) : ?>
							<div class="faq-list">
								<?php while (have_rows('faqs')) : the_row();
									$q = get_sub_field('question');
									$a = get_sub_field('answer');
								?>
									<div class="faq-item">
										<div class="faq-question">
											<h4><?php echo wp_kses_post($q); ?></h4>
											<div class="faq-icon"></div>
										</div>
										<div class="faq-answer">
											<div class="faq-answer-inner">
												<div class="answer-line"></div>
												<?php echo wp_kses_post($a); ?>
											</div>
										</div>
									</div>
								<?php endwhile; ?>
							</div>
						<?php endif; ?>
					</div>
				</section>
	<?php
			}
		}
	}
	?>
</main>

<?php
get_footer();
