<?php
/*
Class Name: bulma_pagination
Description: Custom pagination using Bulma components (tested with Bulma 0.6.2 on WordPress 4.9.4)
Version: 0.2
Author: Domenico Majorana
*/


function alera_bulma_pagination() {
  global $wp_query;
  $big = 999999999; //I trust StackOverflow.
  $total_pages = $wp_query->max_num_pages; //you can set a custom int value to this var
  $pages = paginate_links( array(
    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
    'format' => '?paged=%#%',
    'current' => max( 1, get_query_var('paged') ),
    'total' => $total_pages,
    'prev_next' => false,
    'type'  => 'array',
    'prev_next'   => true,
    'prev_text'    => __( 'Previous', 'alera' ),
    'next_text'    => __( 'Next', 'alera'),
  ) );

  if ( is_array( $pages ) ) {
  //Get current page
    $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var( 'paged' );

    echo '<div class="posts-pagination">';

      //Disable Previous button if the current page is the first one
        if ($paged == 1) {
          echo '<a class="pagination-previous" disabled>Previous</a>';
        } else {
          echo '<a class="pagination-previous" href="' . esc_url(get_previous_posts_page_link()) . '">Previous</a>';
        }

      //Disable Next button if the current page is the last one
        if ($paged<$total_pages) {
          echo '<ul class="pagination-list">';
        } else {
          echo '<ul class="pagination-list">';
        }

        for ($i=1; $i<=$total_pages; $i++) {
          if ($i == $paged) {
            echo '<li><a class="pagination-link is-current" href="' . esc_url(get_pagenum_link($i)) . '">' . esc_html($i) . '</a></li>';
          } else {
            echo '<li><a class="pagination-link" href="'. esc_url(get_pagenum_link($i)) . '">' . esc_html($i) . '</a></li>';
          }
        }

        echo '</ul>';

        if ($paged<$total_pages) {
            echo '<a class="pagination-next" href="' . esc_url(get_next_posts_page_link()) . '">Next</a>';
        } else {
            echo '<a class="pagination-next" disabled>Next</a>';
        }

    echo '</div>';
  }
}