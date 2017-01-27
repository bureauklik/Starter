<?php

if( class_exists( 'acf' ) ) {
	if( have_rows( 'layouts' ) ): $i = 0;
		while ( have_rows( 'layouts' ) ) : $i++; the_row();
			switch ( get_row_layout() ) {

				/*--------------------------------------------------------------
				# Columns
				--------------------------------------------------------------*/
				case 'columns':
					$row_class = get_sub_field( 'row_class' );
					$row_layout = get_sub_field( 'row_layout' );
					$row_options = get_sub_field( 'row_options' );
					$column_type = get_sub_field( 'column_type' );

					if ( $row_options ) {
						$options = implode(' ', $row_options);
					} else {
						$options = '';
					}

					if ( get_sub_field('row_image') ) {
						$background = ' style="background-image: url(%1$s);"';
						$background = sprintf( $background,
							esc_attr(get_sub_field( 'row_image' ))
						);
						$row_class .= ' bg_img';
					} else {
						$background = '';
					}

					echo '<div class="acf_wide ' . $row_class . ' ' . $options . '" data-stretch-type="' . $row_layout . '"' . $background .' id="row-'.$i.'">';
					echo '<div class="acf_columns ' . $column_type . '">';

					if ( get_sub_field( 'column_type' ) == 'cols_1' ) {
						echo '<div class="grid-cell">' . get_sub_field( 'col_1' ) . '</div>';
					} elseif ( get_sub_field( 'column_type' ) == 'cols_1_small' ) {
						echo '<div class="grid-cell">' . get_sub_field( 'col_1' ) . '</div>';
					} elseif ( get_sub_field( 'column_type' ) == 'cols_2' ) {
						echo '<div class="grid-cell">' . get_sub_field( 'col_1' ) . '</div>';
						echo '<div class="grid-cell">' . get_sub_field( 'col_2' ) . '</div>';
					} elseif ( get_sub_field( 'column_type' ) == 'cols_3' ) {
						echo '<div class="grid-cell">' . get_sub_field( 'col_1' ) . '</div>';
						echo '<div class="grid-cell">' . get_sub_field( 'col_2' ) . '</div>';
						echo '<div class="grid-cell">' . get_sub_field( 'col_3' ) . '</div>';
					} elseif ( get_sub_field( 'column_type' ) == 'left_wide' ) {
						echo '<div class="grid-cell">' . get_sub_field( 'col_1' ) . '</div>';
						echo '<div class="grid-cell">' . get_sub_field( 'col_2' ) . '</div>';
					} elseif ( get_sub_field( 'column_type' ) == 'right_wide' ) {
						echo '<div class="grid-cell">' . get_sub_field( 'col_1' ) . '</div>';
						echo '<div class="grid-cell">' . get_sub_field( 'col_2' ) . '</div>';
					} elseif ( get_sub_field( 'column_type' ) == 'cols_4' ) {
						echo '<div class="grid-cell">' . get_sub_field( 'col_1' ) . '</div>';
						echo '<div class="grid-cell">' . get_sub_field( 'col_2' ) . '</div>';
						echo '<div class="grid-cell">' . get_sub_field( 'col_3' ) . '</div>';
						echo '<div class="grid-cell">' . get_sub_field( 'col_4' ) . '</div>';
					}
					echo '</div></div>';
				break;

			}
		endwhile;
	endif;
}