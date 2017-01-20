<?php


function pricing_table_shortcode($atts) {
  extract(shortcode_atts(array(
          "id" => '',
          "template" => 'default',
  ), $atts));
  
  return do_pricing_table( $id, $template );
}
add_shortcode("pricing_table", "pricing_table_shortcode");

function do_pricing_table( $id, $template ) {
  
  $title = get_the_title($id);
  $plans = get_field('plans', $id);
  $feature_list = get_field('standard_feature_list', $id);

  if ( $plans ) {

    echo '<div id="pricing-plan-' . $id . '">';

    foreach ( $plans as $plan ) { ?>

      <div class="plan">

        <h2 class="plan-title"><?php echo $plan['plan_title']; ?></h2>

        <?php if ( $plan['plan_description'] ) { ?>

        <h3 class="plan-description"><?php echo $plan['plan_description']; ?></h3>

        <?php } ?>

        <?php if ( $plan['monthly_price'] ) { ?>

        <p class="monthly price"><span class="sup">$</span><?php echo $plan['monthly_price']; ?>/month</p>

        <?php } ?>

        <?php if ( $plan['quarterly_price'] ) { ?>

        <p class="quarterly price"><span class="sup">$</span><?php echo $plan['quarterly_price']; ?>/quarter</p>

        <?php } ?>

        <?php if ( $plan['yearly_price'] ) { ?>

        <p class="yearly price"><span class="sup">$</span><?php echo $plan['yearly_price']; ?>/year</p>

        <?php } ?>

        <?php if ( $feature_list ) { ?>

        <ul class="plan-features">

          <?php foreach ( $feature_list as $feature ) { ?>

            <?php $available_features = $plan['standard_features']; ?>
            <?php $maybe_has_feature = in_array( $feature['feature'], $available_features ) ? ' has-feature' : ''; ?>

            <li class="feature<?php echo $maybe_has_feature; ?>"><?php echo $feature['feature']; ?></li>

          <?php } ?>

        </ul>

        <?php } ?>

        <a class="button" href="<?php echo $plan['button_url']; ?>"><?php echo $plan['button_text']; ?></a>

      </div>

    <?php }

    echo '</div>'; 

  }

}