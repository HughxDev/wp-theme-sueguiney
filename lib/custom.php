<?php
/**
 * Custom functions
 */

function filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

//add_theme_support( 'woocommerce' );

function get_user_social( $type ) {
  switch ( $type ) {
    case 'twitter':
      /*
      $socialAccounts = get_user_meta( 1, 'social_accounts', true );

      if ( array_key_exists( 'twitter', $socialAccounts ) ) {
        return array_shift( $socialAccounts['twitter'] )->user;
      }
      */

      $twitterAccount = get_user_meta( 1, 'twitter', true );
      
      if ( !empty( $twitterAccount ) ) {
        return $twitterAccount;
      }
      break;

    case 'facebook':
      /*
      $socialAccounts = get_user_meta( 1, 'social_accounts', true );
      
      if ( array_key_exists( 'facebook', $socialAccounts ) ) {
        return array_shift( $socialAccounts['facebook'] )->user;
      }
      */

      $fbAccount = get_user_meta( 1, 'facebook', true );

      if ( !empty( $fbAccount ) ) {
        return $fbAccount;
      }
      break;

    case 'google':
    case 'googleplus':
    case 'google+':
      $googleAccount = get_user_meta( 1, 'googleplus', true );
      
      if ( !empty( $googleAccount ) ) {
        return $googleAccount;
      }
    break;
  }

  return false;
}

function get_social_html_link( $type, $classValue, $linkText = '' ) {
  $type = strtolower( $type );
  $func = 'get_' . $type . '_link';
  $link = $func();

  if ( !empty( $link ) ) {
    return '<li><a class="' . htmlspecialchars( $classValue ) . '" href="' . htmlspecialchars( $link ) . '">' . ( !empty( $linkText ) ? $linkText : ucfirst( $type ) ) . '</a></li>';
  }

  return '';
}

function get_atom_link( $feedURI = false ) {
  if ( $feedURI ) {
    return 'feed://' . preg_replace( '/https?:\/\//i', '', get_bloginfo('atom_url') );
  }

  return get_bloginfo('atom_url');										
}

function get_user_twitter() {
  return get_user_social( 'twitter' );
}

function get_twitter_link() {
  /*
  $twitter = get_user_twitter();

  if ( is_object( $twitter ) && property_exists( $twitter, 'screen_name' ) ) {
    return '//twitter.com/' . $twitter->screen_name;
  }*/
  $twitterUsername = get_user_social( 'twitter' );

  if ( $twitterUsername ) {
    return '//twitter.com/' . $twitterUsername;
  }

  return $twitterLink;
}

function get_user_facebook() {
  return get_user_social( 'facebook' );
}

function get_facebook_link() {
  /*
  $fb = get_user_facebook();

  if ( is_object( $fb ) && property_exists( $fb, 'link' ) ) {
    return preg_replace( '/https?:\/\//i', '//', $fb->link );
  }*/
  $fbLink = get_user_social( 'facebook' );

  if ( $fbLink ) {
    return preg_replace( '/https?:\/\//i', '//',  $fbLink );
  }

  return $fbLink;
}

function get_googleplus_link() {
  $gpLink = get_user_social( 'googleplus' );

  if ( $gpLink ) {
    return $gpLink . '?rel=publisher';
  }

  return $gpLink;
}

// http://wordpress.org/support/topic/how-to-get-the-current-post-slug#post-332470
function get_the_slug() {
  global $post;

  return $post->post_name;
}

function the_slug() {
  echo get_the_slug();
}

function roots_wrap_base_cpts($templates) {
  $cpt = get_post_type(); // Get the current post type
  if ($cpt) {
     array_unshift($templates, 'base-' . $cpt . '.php'); // Shift the template to the front of the array
  }
  return $templates; // Return our modified array with base-$cpt.php at the front of the queue
}

function custom_post_class( $classes ) {
  if ( in_array( 'hentry', $classes ) ) {
    $classes[] = 'entry';
  }

  return $classes;
}

// http://wordpress.org/support/topic/stripping-table-tags-in-content
// http://pastebin.com/rGG3besF
function clean_blogger_import_html( $content ) {
$find = array(
  '/<div><\/div>/',
  '/<div>/',
  '/<\/div>/',
  '/<(\/?)span>/',
  '/<table(?:[^>]+)?>/',
  '/<\/table>/',
  '/<tbody>/',
  '/<\/tbody>/',
  '/<tr>/',
  '/<\/tr>/',
  '/<td>/',
  '/<\/td>/',
  '/<th>/',
  '/<\/th>/',
  '/<a( href="[^"]+")( imageanchor="[^"]+")>/',
  '/<img( border="[^"]+")([^>]+)>/',
  '/\s\s+/',
);

$replace = array(
  '',
  '<p class="import-div">',
  '</p>',
  '<!--$1import-span-->',
  '<figure class="import-table">',
  '</figure>',
  '',
  '',
  '<div class="import-tr">',
  '</div>',
  '<p class="import-td">',
  '</p>',
  '<h3 class="import-th">',
  '</h3>',
  '<a$1>',
  '<img$2 alt=" ">',
  ' ',
);

$content = preg_replace( $find, $replace, $content );

// Second Pass
$find2 = array(
  '/<br(?:\s*\/)?\>\s*<br(?: \/)?\>/',
  '/<p><br(?:\s*\/)?\><\/p>\n*/',
  '/<figure class="import-table">\s*<div class="import-tr">\s*<p class="import-td">\s*(<a.*><img.*><\/a>)\s*<\/p>\s*<\/div>\s*<div class="import-tr">\s*<p class="import-td">(.*)<\/p>\s*<\/div>\s*<\/figure>/',
  '/<p>\W*<b>(.*)<\/b>\W*<\/p>/',
  '/<p class="import-div">/',
);

$replace2 = array(
  '</p>',
  '',
  '<figure>$1<figcaption>$2</figcaption></figure>',
  '<h4 class="h section-title">$1</h4>',
  '<p>'
);

$content = preg_replace( $find2, $replace2, $content );

return $content;
}

function my_limit_archives( $args ) {
    $args['limit'] = 12;
    return $args;
}

function super_dates( $content ) {
  $patterns = array();
  $replacements = array();

  // Ordinal suffixes
  $patterns[] = '/([0-9]+)(st|nd|rd|th)/';
  $replacements[] = '$1<sup>$2</sup>';

  // Day of the Week Abbreviations
  $patterns[] = '/\bMon\b/';
  $replacements[] = '<abbr title="Monday">$0</abbr>';

  $patterns[] = '/\bTue\b/';
  $replacements[] = '<abbr title="Tuesday">$0</abbr>';

  $patterns[] = '/\bWed\b/';
  $replacements[] = '<abbr title="Tuesday">$0</abbr>';

  $patterns[] = '/\bThu\b/';
  $replacements[] = '<abbr title="Thursday">$0</abbr>';  

  $patterns[] = '/\bFri\b/';
  $replacements[] = '<abbr title="Friday">$0</abbr>';

  $patterns[] = '/\bSat\b/';
  $replacements[] = '<abbr title="Saturday">$0</abbr>';

  $patterns[] = '/\bSun\b/';
  $replacements[] = '<abbr title="Sunday">$0</abbr>';

  // Month Abbreviations
  $patterns[] = '/\bJan\b/';
  $replacements[] = '<abbr title="January">$0</abbr>';

  $patterns[] = '/\bFeb\b/';
  $replacements[] = '<abbr title="February">$0</abbr>';

  $patterns[] = '/\bMarch\b/';
  $replacements[] = '<abbr title="March">$0</abbr>';

  $patterns[] = '/\bApr\b/';
  $replacements[] = '<abbr title="Apr">$0</abbr>';  

  $patterns[] = '/\bJune\b/';
  $replacements[] = '<abbr title="June">$0</abbr>';

  $patterns[] = '/\bJul\b/';
  $replacements[] = '<abbr title="July">$0</abbr>';

  $patterns[] = '/\bAug\b/';
  $replacements[] = '<abbr title="August">$0</abbr>';

  $patterns[] = '/\bSep\b/';
  $replacements[] = '<abbr title="September">$0</abbr>';  

  $patterns[] = '/\bOct\b/';
  $replacements[] = '<abbr title="October">$0</abbr>';

  $patterns[] = '/\bNov\b/';
  $replacements[] = '<abbr title="November">$0</abbr>';

  $patterns[] = '/\bDec\b/';
  $replacements[] = '<abbr title="December">$0</abbr>';

  // Year Abbreviations, uses special format ^Y -> ’y (’<abbr title="Y">y</abbr>)
  $patterns[] = '/\^([0-9]{4,})/e';
  $replacements[] = '"’<abbr title=\"$1\">" . substr( $1, 2 ) . "</abbr>"';

  return preg_replace( $patterns, $replacements, $content );
}

class CustomArchive {
  public $output = 'html'; // html|array
  public $format = 'list'; // list|table
  public $display = 'separate'; // separate|combined
  public $headingTag = 'h3';
  public $listTag = 'ol';
  public $containerTag = 'section';
  public $showPostCount = true;
  public $listClasses = 'archive-list list-clean';
  
  private $sortOrder = 'DESC';
  private $html = '';

  protected $archives = array();
  protected $archiveResults;
  protected $queried = 0;

  function __set( $name, $value ) {
    switch ( $name ) {
      case 'sortOrder':
        $value = strtolower( $value );

        switch ( $value ) {
          case 'ascending':
          case 'asc':
          case 'forward':
          case 'up':
            $this->$name = 'ASC';
          break;

          case 'descending':
          case 'desc':
          case 'reverse':
          case 'reversed':
          case 'down':
          default:
            $this->$name = 'DESC';
          break;
        }
        break;
    }
  }

  private function isTable() {
    return ( $this->format == 'table' );
  }

  private function isCombined() {
    return ( $this->display == 'combined' );
  }

  private function runQuery() {
    global $wpdb;

    $this->archiveResults = $wpdb->get_results(
      "SELECT DISTINCT MONTH( post_date ) AS month ,
      YEAR( post_date ) AS year,
      COUNT( id ) as post_count FROM $wpdb->posts
      WHERE post_status = 'publish' and post_date <= now( )
      and post_type = 'post'
      GROUP BY month, year
      ORDER BY post_date {$this->sortOrder}"
    );

    foreach ( $this->archiveResults as $archiveResult ) {
      $year = $archiveResult->year;
      unset( $archiveResult->year );

      $this->archives[$year][] = $archiveResult; // month => 1, post_count => 30
    }

    ++$this->queried;
  }

  function render() {
    if ( !$this->queried ) {
      $this->runQuery();
    }

    $isTable = $this->isTable();
    $isCombined = $this->isCombined();
    $showPostCount = $this->showPostCount;

    if ( $this->output == 'html' ) {
      if ( empty( $this->html ) ) {
        $yearPrev = null;

        foreach( $this->archives as $year => $archive ) {
          foreach( $archive as $monthObj ) {
            $yearCurrent = $year;
            $month = $monthObj->month;
            $posts = $monthObj->post_count;
          
            if ( $yearCurrent != $yearPrev ) {
              if ( !empty( $yearPrev ) ) {
                $this->html .=
                  ( $isTable ? "</table>" : "</{$this->listTag}>" ) .
                  "</{$this->containerTag}>"
                ;
              }

              $this->html .=
                "<{$this->containerTag} id=\"archive-$year\" class=\"archive-index archive-$year\">\n" .
                "<{$this->headingTag} class=\"h headline\">$year</{$this->headingTag}>\n" .
                (
                  $isTable ? "<table class=\"{$this->listClasses}\">\n<tr>\n<th scope=\"col\">Month</th>\n" . 
                  ( $showPostCount ? "<th scope=\"col\">Posts</th>\n</tr>" : '' ) :
                  "<{$this->listTag} class=\"{$this->listClasses}\"" . ( $this->listTag == 'ol' && $this->sortOrder == 'DESC' ? ' reversed="reversed">' : '>' )
                ) . "\n"
              ;
            } //endif
            
            $this->html .=
              ( $isTable ? "<tr>\n<td>" : '<li>' ) .
              '<a href="' . get_bloginfo( 'url' ) . "/$year/" .
              date( "m", mktime( 0, 0, 0, $month, 1, $year ) ) .
              '/"><span class="archive-month">' .
              date( "F", mktime( 0, 0, 0, $month, 1, $year ) ) .
              '</span></a> ' .
              ( $showPostCount ?
                ( $isTable ? "</td>\n<td>" : '(' ) .
                  "<span class=\"archive-count\">$posts</span>" .
                ( $isTable ? '' : ' posts)' )
                : ''
              ) .
              ( $isTable ? "</td>\n</tr>\n" : '</li>' )
            ;
            
            $yearPrev = $yearCurrent;
          } // endforeach
        } //endforeach

        $this->html .= ( $isTable ? "\n</tr>\n</table>" : "</{$this->listTag}>" );

        echo $this->html;
        return $this;
      } // endif
    } // endif

    var_dump( $this->archives );
    return $this;
  } // print()
} // 2dArchive

//function get_2d_archives( object $options ) {}

// http://stackoverflow.com/a/3835653/214325
function str_lreplace( $search, $replace, $subject ) {
  $pos = strrpos( $subject, $search );

  if ( $pos !== false )
  {
    $subject = substr_replace( $subject, $replace, $pos, strlen( $search ) );
  }

  return $subject;
}

function view_all_archives( $widget_content = '', $widget_id = '' ) {

  // Prepare for the hackiest HTML manipulation known to man...

  function remove_bad_titles( $matches ) {
  /*
    [1] = ' title="September 2013'
    [2] = 'September 2013' (title attribute)
    [3] = 'September 2013' (content)
  */

    if ( $matches[2] === $matches[3] ) {
      return str_replace( $matches[1], '', $matches[0] ); // eliminate with concat
    }

    return $matches[0];
  }

  $yearCurrent = null;
  function remove_redundant_years( $matches ) {
  /*
    [1] => 'September'
    [2] => ' 2013'
    [3] => '2013'
  */
    global $yearCurrent;
    $noYear = str_replace( $matches[2], '', $matches[0] );

    if ( $yearCurrent == null ) {
      $yearCurrent = $matches[3];

      return '<li><b>' . $matches[3] . '</b><ul>' . $noYear;
    }

    if ( $yearCurrent == $matches[3] ) {
      return $noYear;
    }

    if ( $yearCurrent !== $matches[3] ) {
      $yearCurrent = $matches[3];
      
      return '</ul></li><li><b>' . $matches[3] . '</b><ul>' . $noYear;
    }
  }

  $widget_content = preg_replace_callback( '/<a href=["\'][^"\']+["\']( title=["\']([^"\']+)["\'])>([^<]+)<\/a>/', 'remove_bad_titles', $widget_content );
  $widget_content = preg_replace_callback( '/<li><a href=["\'][^"\']+["\']>([a-zA-Z]{3,9})(\s+([0-9]{4,}))<\/a><\/li>/', 'remove_redundant_years', $widget_content );

  if (
    empty( $widget_id ) &&
    preg_match( '/<\w+\s+(?:[a-zA-Z\-]+=["\'][^"\']+["\']\s+)?id=["\']([^"\']+)["\']/', $widget_content, $widget_id_matches ) === 1
  ) {
    $widget_id = $widget_id_matches[1];
  }

  switch ( $widget_id ) {
    case ( strpos( $widget_id, 'archive' ) !== false ):
      return str_lreplace( '</ul>', '</ul></li><li><a href="/archives/">View All</a></li></ul>', $widget_content );
      break;
  }

  return $widget_content;
}

function next_posts_rel( $content ) {
  return $content .= ' rel="next"';
}

function prev_posts_rel( $content ) {
  return $content .= ' rel="prev"';
}

// WP has a literally backwards concept of prev/next
add_filter( 'previous_posts_link_attributes', 'next_posts_rel' );
add_filter( 'next_posts_link_attributes', 'prev_posts_rel' );

add_filter( 'post_thumbnail_html', 'my_post_image_html' );

add_post_type_support( 'page', 'post-formats' );

add_filter( 'get_the_date', 'super_dates' );
add_filter( 'get_comment_date', 'super_dates' );
add_filter( 'the_content', 'filter_ptags_on_images' );
add_filter( 'widget_content', 'view_all_archives' );
add_filter( 'widget_archives_args', 'my_limit_archives' );
add_filter( 'widget_archives_dropdown_args', 'my_limit_archives' );
add_filter( 'the_content', 'clean_blogger_import_html' );
add_filter( 'post_class', 'custom_post_class' );
add_filter( 'roots_wrap_base', 'roots_wrap_base_cpts' ); // Add our function to the roots_wrap_base filter