<?php

/*
 * PAGINATION
 *
  <ol class="pagination">
    <li class=pagination__first>First</li>
    <li class=pagination__prev>Previous</li>
    <li><a href=/page/1>1</a></li>
    <li><a href=/page/2>2</a></li>
    <li class=current><a href=/page/3>3</a></li>
    <li><a href=/page/4>4</a></li>
    <li><a href=/page/5>5</a></li>
    <li class=pagination__next><a href=/page/next>Next</a></li>
    <li class=pagination__last><a href=/page/last>Last</a></li>
   </ol>
 */

function pagination( $pages = '', $range = 2 ) {
  $showitems = ( $range * 2 ) + 1;

  global $paged;

  if ( empty( $paged ) ) { $paged = 1; }

  if ( $pages == '' ) {
    global $wp_query;
    $pages = $wp_query->max_num_pages;
    if ( !$pages ) {
      $pages = 1;
    }
  }

  if ( $pages != 1 ) {
    echo '<ol class="pagination">';
    if ( $paged > 1 ) echo '<li class="pagination__prev"><a href="' . get_pagenum_link( $paged - 1 ) . '" rel="prev">Previous</a></li>';
    if ( $paged > 2 && $paged > ( $range + 1 ) && $showitems < $pages ) echo '<li><a href="' . get_pagenum_link(1) . '">1</a></li>\n<li class="pagination__more"><span>&#8230;</span></li>';

    for ( $i = 1; $i <= $pages; $i++ ) {
      if ( 1 != $pages && ( !( $i >= ( $paged + $range + 1 ) || $i <= ( $paged - $range - 1 ) ) || $pages <= $showitems ) ) {
        echo ( $paged == $i ) ? '<li class="pagination__curr"><span>' . $i . '</span>' : '<a href="' . get_pagenum_link( $i ) . '">' . $i . '</a>'; // This line displays the page number links
      }
    }

    if ( $paged < ( $pages - 1 ) && ( $paged + $range - 1 ) < $pages && $showitems < $pages ) echo '<li class="pagination__more"><span>&#8230;</span></li>\n<li><a href="' . get_pagenum_link( $pages ) . '">' . $pages . '</a></li>';
    if ( $paged < $pages ) echo '<li class="pagination__next"><a href="' . get_pagenum_link( $paged + 1 ) . '" rel="next">Next</a></li>';
    echo '</ol>';
  }
}
