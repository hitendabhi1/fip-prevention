<?php
// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/* common and convenience function */

/**
 * convenience function to get current slug
 */
function current_slug()
{
    return basename(get_permalink());
}

/**
 * Generates header with title, subtitle and background-image if available
 * can ovveride page defaults by feeding arguments
 * @param string $p_strColor
 * @param string $p_strTitle
 * @param string $p_strParentTitle
 * @param string $p_strImageUrl
 * @return string HTML-content
 */
function fipsite_pageHeader( $p_strColor = '', $p_strTitle = '', $p_strParentTitle = '', $p_strImageUrl = '' )
{
    $pageid         = get_the_ID();
    $strColor       = !empty( $p_strColor ) ? $p_strColor : 'blue';
    $strTitle       = !empty( $p_strTitle ) ? $p_strTitle : get_the_title ();
    $strParentTitle = !empty( $p_strParentTitle ) ? $p_strParentTitle : '';
    $post_image     = wp_get_attachment_image_src (get_post_thumbnail_id( $pageid ), 'full' );     $strImageClass  = '';
    $strContent     = '';
    
    $currentMenuId  = fipsite_getCurrentPageMenuID("MainMenu-Primary");
    $cachedMenu     = fipsite_getCache("mainmenu");
    $parentMenuId   = $cachedMenu->getMenuParentId($currentMenuId);
    
    if (! empty($post_image)) {
        $strThemeUrl = get_template_directory_uri();
        $strImage = <<< HEADER_IMAGE
                <img src="{$strThemeUrl}/inc/fw_assets/images/transparent.png" alt="" 
                style="background-image:url({$post_image[0]})">
HEADER_IMAGE;
    } else {
        $strImageClass = "has-no-img";
    }

     $strContent .= <<< PAGEHEADER
        <figure class="content-img header {$strImageClass} ">
            {$strImage}
            <figcaption class="{$strColor} has-ribbon bottom left right">
                <span class="subtitle">{$strParentTitle}</span>
                <h1 class="pagetitle {$strColor}">{$strTitle}</h1>
            </figcaption>
        </figure>
PAGEHEADER;
                
     return $strContent;
}

/**
 * Generate last modified date 
 * @param string $strModifiedDate
 * @param bool $isFormatted need to make readable
 * @return string
 */
function fipsite_pageLastModified ($strModifiedDate, $isFormatted=true)
{
    $strContent = '';
    if (!$isFormatted) // comes from  database like 2020-01-30
        $strModifiedDate = date('j F Y', $strModifiedDate);
    if (!empty($strModifiedDate))
    {
        $strContent = <<< LAST_MODIFIED
            <div class="last-update">
            <i class="fa fa-retweet" aria-hidden="true"></i>
                Last update {$strModifiedDate} 
            </div>
LAST_MODIFIED;
    }
    return $strContent;
}



/* String functions */

function fipsite_get_excerpt( $content, $length = 40, $more = '...' ) {
    $excerpt = strip_tags( trim( $content ) );
    $words = str_word_count( $excerpt, 2 );
    if ( count( $words ) > $length ) {
        $words = array_slice( $words, 0, $length, true );
        end( $words );
        $position = key( $words ) + strlen( current( $words ) );
        $excerpt = substr( $excerpt, 0, $position ) . $more;
    }
    return $excerpt;
}

/**
 * Human readable format
 *
 * @param string $strDate 2020-01-23
 * @return string
 */
function fipsite_defaultDateFormat($strDate)
{
    return date("j F Y", strtotime($strDate));
}

/**
 * Created a standard tabbed object with formatting
 * 
 * @param array $arrTabs    
 *      $arrTabs = array(
 *          array('title'=> 'Previous', 'content' => 'some content'),
 *          array('title'=> 'Next', 'content' => 'some other content'),    
 *      );      
 * @param int $tabOpen which tab should be open, starting @1 
 * @return string html code
 */
function fipsite_buildPageTabs($arrTabs, $tabOpen = -1)
{
    $strContent = '';
    $nTabs = count($arrTabs);
    $pillTabs = '';
    $pillContents = '';
    
    foreach ($arrTabs as $n => $arrTab) {
        $strSubtitle = empty($arrTab['subtitle']) ? "" : $arrTab['subtitle'];
        $strContentActive = ((! empty($arrTab['active']) && $arrTab['active']) || ($n + 1) == $tabOpen) ? " show active " : "";
        $strTabActive     = ((! empty($arrTab['active']) && $arrTab['active']) || ($n + 1) == $tabOpen) ? "  active " : "";
        $strAriaActive    = ((! empty($arrTab['active']) && $arrTab['active']) || ($n + 1) == $tabOpen) ? '  aria-selected="true" ' : "";
        $strUrl = "href='#pills-{$n}'";
        if (! empty($arrTab['url']))
            $strUrl = "onclick='location.href=\"{$arrTab['url']}\";'";
        $pillTabs .= <<< PILL_TAB
        <a class="nav-link {$strTabActive} tab-item tab-item-col{$nTabs}" id="pills-tab-{$n}" data-toggle="pill" {$strUrl} role="tab" aria-controls="pills-{$n}"
               {$strAriaActive}><span>{$arrTab['title']}</span>
                {$strSubtitle}
           </a>
PILL_TAB;
        
        $strTabContent = ! empty($arrTab['content']) ? $arrTab['content'] : '';
        $pillContents .= <<< PILL_CONTENT
            <div class="tab-pane fade {$strContentActive}" id="pills-{$n}" role="tabpanel" aria-labelledby="pills-{$n}-tab">{$strTabContent}</div>
PILL_CONTENT;
    }
    
    $strContent = <<< TABS
    
        <nav class="nav nav-pills mb-my-3 tab-bar" id="pills-tab" role="tablist">
                {$pillTabs}
        </nav>
        <div class="tab-content" id="pills-tabContent">
                {$pillContents}
        </div>
TABS;
    return $strContent;
}


