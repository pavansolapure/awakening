<?php
/**
 * Searchform
 *
 * Custom template for search form
 *
 * @package Awakening
 * @since Awakening 0.1
 */
?>

<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="row">
		<div class="large-12 columns">
			<div class="row collapse">
				<div class="small-10 columns">
					<input type="text" name="s" id="s" placeholder="<?php esc_attr_e( 'Search', 'awakening' ); ?>"/>
				</div>
				<div class="small-2 columns">					
					<a href="#" class="button postfix"><i class="fa fa-search"></i></a>
				</div>
			</div>
		</div>
	</div>
</form>
