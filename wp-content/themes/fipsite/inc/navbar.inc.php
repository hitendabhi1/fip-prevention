<?php 
/**
 * helper functions for navigation bar(s)
 *
 * Contains the top, main and bottom footer bar
 * 
 * @package fipsite
 */
// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

function createBootstrapNavbar($mainMenu)
{
    $strContent = '';
    
    $arrTree = $mainMenu->getTree();
    $strMenus = _createBootstrapMenus($arrTree);
    $strSiteUrl = site_url();
    $strSiteLogo = get_template_directory_uri()."/assets/img/site-logo.png";
	$strBacktofip = get_template_directory_uri()."/assets/img/back_to_fip.png";

    $strMainMenu = <<< MENU
        
    <div class="container">
        <div class="header-nav row">
            <div class="col m-0 p-0">
                <div id="nav_wrapper">
                    <!-- MegaNavbar BS4 -->
                      
                    <nav class="navbar navbar-inverse navbar-expand-lg  m-0 p-0 navbar-light" id="main_navbar" role="navigation" data-offset="471">
                    <div class="container pl-0">
                    <!-- MegaNavbar BS4 brand -->
					 <a class="navbar-brand navbar-brand-home-logo" style="margin-right:10px;" href="https://www.fip.org"><img src="{$strBacktofip}" class="navbar-logo-img"></a>
                      <a class="navbar-brand navbar-brand-home-logo" href="{$strSiteUrl}"><img src="{$strSiteLogo}" class="navbar-logo-img"></a>
                    <!-- <a class="navbar-brand" href="#"><i class="fa fa-home"></i> FIP Foundation </a>-->
                    <!-- MegaNavbar BS4 toggler -->
<!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">-->
<!--<button class="navbar-toggler" type="button" data-toggle="offsite" data-target="#leftMenu" data-canvas="#page-wrapper" 
    aria-controls="page-wrapper" aria-expanded="false" aria-label="Toggle navigation">--> <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbar">
                        <ul class="navbar-nav ml-auto">
                        
                            <!-- menus -->
                            {$strMenus}
                            
                        </ul>
                    </div>
                </div> <!-- nav_wrapper -->
            </div>
        </div>
    </div>
MENU;
     return $strMainMenu;
}

function _menuSlug ($arrMenu)
{
    return get_permalink($arrMenu->object_id);
}

function _createBootstrapMenus ($arrTree) 
{
    $strContent = '';
    
    $nCols = 2;
    $nMenus = count($arrTree);
    $nRows = round($nMenus/$nCols);
    $strLast = '';
    foreach ($arrTree as $arrMenu)
    {
        $strTitle = $arrMenu->title;
        $strUrl = $arrMenu->url;
        if (empty($strUrl))
            $strUrl = _menuSlug($arrMenu); 
        $nSubmenus = count($arrMenu->children);
        $hasKids = ($nSubmenus >0);
        $level = $arrMenu->level;     
        
        $n=1;
        if ($level==1)
        {
            $strHeaderClass = ($arrMenu->categorytype=='spotlight') ? 'spotlight' : 'regular';    
            $strExtraClass = ($arrMenu->categorytype=='spotlight') ? "" /* left */ : "dropdown-menu-right";

            if ($strHeaderClass != $strLast) /* reset */
                $n = 1;
            else 
                $n++;
            $strLast = $strHeaderClass;
            $strExtraClassNumber = $n;
           
            if ($hasKids)
            {
               if (empty($strUrl)) $strUrl = "#";
                    $strMenuIdentifier = "id_dropdown_".$arrMenu->ID; //data-toggle="collapse"
                $strContent .= <<< TOPMENU_DROPDOWN

                <li class="nav-item dropdown show nav-item-{$strHeaderClass} nav-item-{$strHeaderClass}-{$n}">
                        
                    <a class="nav-link dropdown-toggle nav-link-{$strHeaderClass}" href="{$strUrl}" id="{$strMenuIdentifier}" 
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><span class="nav-link-title">{$strTitle}</span></a>
                        <div class="dropdown-menu {$strExtraClass} ffade " aria-labelledby="{$strMenuIdentifier}">
TOPMENU_DROPDOWN;
                if ($nSubmenus>0 && $arrMenu->level==1)
                {
                    $strContent .= _createBootstrapMenus($arrMenu->children);
                }
                $strContent .= <<< TOPMENU_END
                        </div>
                </li>
TOPMENU_END;
            } else
            {
                $strContent .= <<< TOPMENU_REGULAR
                    <li class="nav-item">
                            <a class="nav-link" href="{$strUrl}"><span class="nav-link-title">{$strTitle}</span></a>
                    </li>
TOPMENU_REGULAR;
            }
        } elseif ($level==2)
        {
            $strContent .= <<< MENU_ITEM
            <a class="dropdown-item" href="{$strUrl}"><span class="nav-link-title">{$strTitle}</span></a>
MENU_ITEM;
        }
    }
    return $strContent;
}
    

  
function _createNavMenu ($arrTree)
{
    $strContent = '';
    
    $nCols = 2;
    $nMenus = count($arrTree);
    $nRows = round($nMenus/$nCols);
    
    foreach ($arrTree as $arrMenu)
    {
       $strTitle = $arrMenu->title;
       $strUrl = $arrMenu->url;
       $nSubmenus = count($arrMenu->children);
       $hasKids = ($nSubmenus >0);
       $level = $arrMenu->level;
       
       if ($level==1)
       {
           if ($hasKids)
           {
               $strMenuIdentifier = "id_dropdown_".$arrMenu->ID; //data-toggle="collapse"
                $strContent .= <<< TOPMENU_DROPDOWN
                <div class="nav-divider"></div>
                <div class="nav-item dropdown">
                    <a class="dropdown collapse" href="#{$strMenuIdentifier}" data-toggle="popover" aria-haspopup="true" aria-expanded="false">{$strTitle}</a>
                    <div class="dropdown-menu collapse" id="{$strMenuIdentifier}">
TOPMENU_DROPDOWN;
                if ($nSubmenus>0 && $arrMenu->level==1)
                {
                    $strContent .= _createNavMenu($arrMenu->children);
                }
                $strContent .= <<< TOPMENU_END
                    </div>
                </div>    
TOPMENU_END;
           } else
           {
               $strContent .= <<< TOPMENU_REGULAR
                    <div class="nav-divider"></div>
                    <div class="nav-item"><a class="nav-link" href="{$strUrl}">{$strTitle}</a></div>
TOPMENU_REGULAR;
           }
            
        } elseif ($level==2)
        {
            $strContent .= <<< MENU_ITEM
          
                    <div class="dropdown-divider m-0"></div>
                    <a class="dropdown-link" href="{$strUrl}" title="dropdown-link">{$strTitle}<!--<span class="description">Regular link description</span>--></a>
MENU_ITEM;
        }       
    }
    
    
    
    return $strContent;
}



function fipsite_topNavBar()
{
    $strContent = '';
    $strSiteUrl = site_url();
    $strContent .= <<< TOPNAVBAR
    <div class="header-top-bar">
        <div class="container clearfix">
            <ul class="header-top-bar-nav">
                <li><a href="{$strSiteUrl}" class="header-top-bar-nav-home"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                <li><a href="{$strSiteUrl}/contact"><i class="fa fa-address-card mo" aria-hidden="true"></i>Contact</a></li>
            </ul>
        </div>
    </div>
TOPNAVBAR;
    return $strContent;
}

