<?php
/**
 * Checkout Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

wc_print_notices();

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) );
	return;
}

// filter hook for include new pages inside the payment method
$get_checkout_url = apply_filters( 'woocommerce_get_checkout_url', WC()->cart->get_checkout_url() ); ?>

<form name="checkout" method="post" class="checkout" action="<?php echo esc_url( $get_checkout_url ); ?>">

	<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>

		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

		<div class="row" id="customer_details">

			<div class="col-xs-12 col-sm-6">

				<?php do_action( 'woocommerce_checkout_billing' ); ?>

			</div>

			<div class="col-xs-12 col-sm-6">

				<?php do_action( 'woocommerce_checkout_shipping' ); ?>

			</div>

		</div>

		<?php if ( ! is_user_logged_in() && $checkout->enable_signup ) : ?>

			<?php if ( $checkout->enable_guest_checkout ) : ?>

				<div class="checkbox create-account">
					<label for="createaccount" class="checkbox"><input class="input-checkbox" id="createaccount" <?php checked( ( true === $checkout->get_value('createaccount') || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true) ?> type="checkbox" name="createaccount" value="1" /> <?php _e( 'Create an account?', 'woocommerce' ); ?></label>
				</div>

			<?php endif; ?>

			<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

			<?php if ( ! empty( $checkout->checkout_fields['account'] ) ) : ?>

			<div class="create-account clearfix">

				<div class="alert alert-warning"><?php _e( 'Create an account by entering the information below. If you are a returning customer please login at the top of the page.', 'woocommerce' ); ?></div>

				<div class="page-header">
					<h3><?php _e( 'Create an Account', 'woocommerce' ); ?></h3>
				</div>

				<?php foreach ($checkout->checkout_fields['account'] as $key => $field) : ?>

					<?php woocommerce_bootstrap_form_field( $key, $field, $checkout->get_value( $key ) ); ?>

				<?php endforeach; ?>

			</div>

			<?php endif; ?>

			<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>

		<?php endif; ?>

		<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

		<div class="page-header">
			<h3 id="order_review_heading"><?php _e( 'Your order', 'woocommerce' ); ?></h3>
		</div>

	<?php endif; ?>

	<?php do_action( 'woocommerce_checkout_order_review' ); ?>

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>