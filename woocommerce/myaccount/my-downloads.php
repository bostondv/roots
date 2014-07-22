<?php
/**
 * My Orders
 *
 * Shows recent orders on the account page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $downloads = WC()->customer->get_downloadable_products() ) : ?>
	
	<div class="page-header">
		<h2 class="entry-title"><?php echo apply_filters( 'woocommerce_my_account_my_downloads_title', __( 'Available downloads', 'woocommerce' ) ); ?></h2>
	</div>
	
	<table class="digital-downloads table table-striped">
		<thead>
			<tr>
				<th>Download Link</th>
				<th># Remaining</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ( $downloads as $download ) : ?>
			<tr>
				<td>
				<?php
					do_action( 'woocommerce_available_download_start', $download );

					echo apply_filters( 'woocommerce_available_download_link', '<a href="' . esc_url( $download['download_url'] ) . '">' . $download['download_name'] . '</a>', $download );
				?>
				</td>
				<td>
				<?php
					if ( is_numeric( $download['downloads_remaining'] ) )
						echo apply_filters( 'woocommerce_available_download_count', '<span class="count">' . sprintf( _n( '%s download remaining', '%s downloads remaining', $download['downloads_remaining'], 'woocommerce' ), $download['downloads_remaining'] ) . '</span> ', $download );

					do_action( 'woocommerce_available_download_end', $download );
				?>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>

<?php endif; ?>