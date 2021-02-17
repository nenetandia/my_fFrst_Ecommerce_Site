<?php
/**
 * Order tracking rendering
 *
 * @package     Boxtal\BoxtalConnectWoocommerce\Assets\Views
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<div class="bw-tracking">
    <?php //phpcs:ignore ?>
	<?php if ( property_exists( $tracking, 'shipmentsTracking' ) && ! empty( $tracking->shipmentsTracking ) ) : ?>

        <?php //phpcs:ignore ?>
		<?php if ( 1 === count( $tracking->shipmentsTracking ) ) : ?>
			<p><?php esc_html_e( 'Your order has been sent in 1 shipment.', 'boxtal-connect' ); ?></p>
		<?php else : ?>
            <?php //phpcs:disable ?>
			<?php /* translators: 1) int number of shipments */ ?>
			<p><?php echo esc_html( sprintf( __( 'Your order has been sent in %s shipments.', 'boxtal-connect' ), count( $tracking->shipmentsTracking ) ) ); ?></p>
            <?php //phpcs:enable ?>
		<?php endif; ?>

        <?php //phpcs:ignore ?>
		<?php foreach ( $tracking->shipmentsTracking as $shipment ) : ?>
			<?php //phpcs:ignore ?>
			<h4><?php echo sprintf( __( 'Shipment reference %s', 'boxtal-connect' ), $shipment->reference ); ?></h4>
            <?php //phpcs:ignore ?>
			<?php $parcel_count = count( $shipment->parcelsTracking ); ?>
			<?php if ( 1 === $parcel_count || 0 === $parcel_count ) : ?>
				<?php /* translators: 1) int number of shipments */ ?>
				<p><?php echo esc_html( sprintf( __( 'Your shipment has %s package.', 'boxtal-connect' ), $parcel_count ) ); ?></p>
			<?php else : ?>
				<?php /* translators: 1) int number of shipments */ ?>
				<p><?php echo esc_html( sprintf( __( 'Your shipment has %s packages.', 'boxtal-connect' ), $parcel_count ) ); ?></p>
			<?php endif; ?>
            <?php //phpcs:ignore ?>
			<?php foreach ( $shipment->parcelsTracking as $parcel ) : ?>
                <?php //phpcs:ignore ?>
                <?php if ( null !== $parcel->trackingUrl ) : ?>
                    <?php //phpcs:ignore ?>
					<p><?php echo sprintf( __( 'Package reference %s', 'boxtal-connect' ), '<a href="' . esc_url( $parcel->trackingUrl ) . '" target="_blank">' . $parcel->reference . '</a>' ); ?></p>
				<?php else : ?>
                    <?php //phpcs:ignore ?>
					<p><?php echo esc_html( sprintf( __( 'Package reference %s', 'boxtal-connect' ), $parcel->reference ) ); ?></p>
				<?php endif; ?>
                <?php //phpcs:ignore ?>
				<?php if ( is_array( $parcel->trackingEvents ) && count( $parcel->trackingEvents ) > 0 ) : ?>
                    <?php //phpcs:ignore ?>
					<?php foreach ( $parcel->trackingEvents as $event ) : ?>
						<p>
							<?php
								$date = new DateTime( $event->date );
								echo esc_html( $date->format( __( 'Y-m-d H:i:s', 'boxtal-connect' ) ) . ' ' . $event->message );
							?>
						</p>
					<?php endforeach; ?>

				<?php else : ?>
					<p><?php esc_html_e( 'No tracking event for this package yet.', 'boxtal-connect' ); ?></p>
				<?php endif; ?>
				<br/>
			<?php endforeach; ?>
		<?php endforeach; ?>

	<?php endif; ?>
</div>
