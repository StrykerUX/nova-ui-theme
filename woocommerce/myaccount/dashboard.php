<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package NovaUI
 * @subpackage WooCommerce
 */

defined( 'ABSPATH' ) || exit;

// NovaUI custom hook before dashboard
do_action( 'novaui_before_dashboard' );

/**
 * My Account dashboard.
 *
 * @since 2.6.0
 */
do_action( 'woocommerce_account_dashboard' );

// NovaUI custom styles for dashboard section
?>
<div class="woocommerce-dashboard-section">
	<div class="woocommerce-dashboard-section-header">
		<h3 class="woocommerce-dashboard-section-title">
			<?php echo esc_html__( 'Dashboard', 'nova-ui' ); ?>
		</h3>
	</div>
	<div class="woocommerce-dashboard-section-content">
		<p>
			<?php
			printf(
				/* translators: 1: user display name 2: logout url */
				__( 'Hello %1$s (not %1$s? <a href="%2$s">Log out</a>)', 'woocommerce' ),
				'<strong>' . esc_html( $current_user->display_name ) . '</strong>',
				esc_url( wc_logout_url() )
			);
			?>
		</p>

		<p>
			<?php
			/* translators: 1: Orders URL 2: Address URL 3: Account URL. */
			$dashboard_desc = __(
				'From your account dashboard you can view your <a href="%1$s">recent orders</a>, manage your <a href="%2$s">billing address</a>, and <a href="%3$s">edit your password and account details</a>.',
				'woocommerce'
			);
			if ( wc_shipping_enabled() ) {
				/* translators: 1: Orders URL 2: Addresses URL 3: Account URL. */
				$dashboard_desc = __(
					'From your account dashboard you can view your <a href="%1$s">recent orders</a>, manage your <a href="%2$s">shipping and billing addresses</a>, and <a href="%3$s">edit your password and account details</a>.',
					'woocommerce'
				);
			}
			printf(
				$dashboard_desc,
				esc_url( wc_get_endpoint_url( 'orders' ) ),
				esc_url( wc_get_endpoint_url( 'edit-address' ) ),
				esc_url( wc_get_endpoint_url( 'edit-account' ) )
			);
			?>
		</p>
	</div>
</div>

<?php
// NovaUI custom cards section
?>
<div class="woocommerce-dashboard-cards">
	<div class="woocommerce-dashboard-card">
		<div class="woocommerce-dashboard-card-header">
			<h4 class="woocommerce-dashboard-card-title"><?php esc_html_e( 'Recent Orders', 'nova-ui' ); ?></h4>
			<a href="<?php echo esc_url( wc_get_endpoint_url( 'orders' ) ); ?>" class="woocommerce-dashboard-card-action">
				<?php esc_html_e( 'View All', 'nova-ui' ); ?>
			</a>
		</div>
		<div class="woocommerce-dashboard-card-content">
			<?php
			$args = array(
				'customer_id' => get_current_user_id(),
				'limit' => 5,
			);
			$orders = wc_get_orders( $args );

			if ( $orders ) :
				?>
				<ul class="woocommerce-dashboard-orders-list">
					<?php foreach ( $orders as $order ) : ?>
						<li class="woocommerce-dashboard-order-item">
							<a href="<?php echo esc_url( $order->get_view_order_url() ); ?>">
								<span class="order-number">#<?php echo $order->get_order_number(); ?></span>
								<span class="order-date"><?php echo wc_format_datetime( $order->get_date_created() ); ?></span>
								<span class="order-status">
									<span class="order-status-badge order-status-<?php echo esc_attr( $order->get_status() ); ?>">
										<?php echo wc_get_order_status_name( $order->get_status() ); ?>
									</span>
								</span>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php else : ?>
				<p class="woocommerce-dashboard-no-orders">
					<?php esc_html_e( 'No order has been made yet.', 'nova-ui' ); ?>
				</p>
			<?php endif; ?>
		</div>
	</div>

	<?php if ( class_exists( 'WC_Subscriptions' ) ) : // Subscriptions support ?>
	<div class="woocommerce-dashboard-card">
		<div class="woocommerce-dashboard-card-header">
			<h4 class="woocommerce-dashboard-card-title"><?php esc_html_e( 'Subscriptions', 'nova-ui' ); ?></h4>
			<a href="<?php echo esc_url( wc_get_endpoint_url( 'subscriptions' ) ); ?>" class="woocommerce-dashboard-card-action">
				<?php esc_html_e( 'View All', 'nova-ui' ); ?>
			</a>
		</div>
		<div class="woocommerce-dashboard-card-content">
			<?php
			$args = array(
				'customer_id' => get_current_user_id(),
				'limit' => 5,
			);
			$subscriptions = wcs_get_subscriptions( $args );

			if ( $subscriptions ) :
				?>
				<ul class="woocommerce-dashboard-subscriptions-list">
					<?php foreach ( $subscriptions as $subscription ) : ?>
						<li class="woocommerce-dashboard-subscription-item">
							<a href="<?php echo esc_url( $subscription->get_view_order_url() ); ?>">
								<span class="subscription-id">#<?php echo $subscription->get_id(); ?></span>
								<span class="subscription-next-payment">
									<?php 
									$next_payment = $subscription->get_date( 'next_payment' );
									if ( $next_payment ) {
										echo esc_html__( 'Next payment:', 'nova-ui' ) . ' ' . wc_format_datetime( $next_payment );
									}
									?>
								</span>
								<span class="subscription-status">
									<span class="subscription-status-badge subscription-status-<?php echo esc_attr( $subscription->get_status() ); ?>">
										<?php echo wcs_get_subscription_status_name( $subscription->get_status() ); ?>
									</span>
								</span>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php else : ?>
				<p class="woocommerce-dashboard-no-subscriptions">
					<?php esc_html_e( 'You don\'t have any active subscriptions.', 'nova-ui' ); ?>
				</p>
			<?php endif; ?>
		</div>
	</div>
	<?php endif; ?>

	<?php if ( class_exists( 'WC_Memberships' ) ) : // Memberships support ?>
	<div class="woocommerce-dashboard-card">
		<div class="woocommerce-dashboard-card-header">
			<h4 class="woocommerce-dashboard-card-title"><?php esc_html_e( 'Memberships', 'nova-ui' ); ?></h4>
			<a href="<?php echo esc_url( wc_get_endpoint_url( 'members-area' ) ); ?>" class="woocommerce-dashboard-card-action">
				<?php esc_html_e( 'View All', 'nova-ui' ); ?>
			</a>
		</div>
		<div class="woocommerce-dashboard-card-content">
			<?php
			$args = array(
				'customer_id' => get_current_user_id(),
				'status' => array( 'active', 'pending', 'paused' ),
			);
			$memberships = wc_memberships_get_user_memberships( get_current_user_id(), $args );

			if ( $memberships ) :
				?>
				<ul class="woocommerce-dashboard-memberships-list">
					<?php foreach ( $memberships as $membership ) : 
						$plan = $membership->get_plan();
						$end_date = $membership->get_end_date();
						?>
						<li class="woocommerce-dashboard-membership-item">
							<a href="<?php echo esc_url( wc_memberships_get_members_area_url( $membership->get_plan_id() ) ); ?>">
								<span class="membership-plan"><?php echo esc_html( $plan->get_name() ); ?></span>
								<?php if ( $end_date ) : ?>
								<span class="membership-expiry">
									<?php echo esc_html__( 'Expires:', 'nova-ui' ); ?> <?php echo date_i18n( wc_date_format(), strtotime( $end_date ) ); ?>
								</span>
								<?php endif; ?>
								<span class="membership-status">
									<span class="membership-status-badge membership-status-<?php echo esc_attr( $membership->get_status() ); ?>">
										<?php echo wc_memberships_get_user_membership_status_name( $membership->get_status() ); ?>
									</span>
								</span>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php else : ?>
				<p class="woocommerce-dashboard-no-memberships">
					<?php esc_html_e( 'You don\'t have any active memberships.', 'nova-ui' ); ?>
				</p>
			<?php endif; ?>
		</div>
	</div>
	<?php endif; ?>
</div>

<?php
/**
 * Deprecated woocommerce_before_my_account action.
 *
 * @deprecated 2.6.0
 */
do_action( 'woocommerce_before_my_account' );

/**
 * Deprecated woocommerce_after_my_account action.
 *
 * @deprecated 2.6.0
 */
do_action( 'woocommerce_after_my_account' );

// NovaUI custom hook after dashboard
do_action( 'novaui_after_dashboard' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
