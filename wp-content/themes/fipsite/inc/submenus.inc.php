<?php

function fipsite_getCache($strKey)
{
    return wp_cache_get($strKey);
}
    
function fipsite_setCache($strKey, $val)
{
    wp_cache_set($strKey, $val);
}

function fipsite_getMenuSibblings($strMenuName)
{
    global $post;
    $strHTML = '';

    //$mainMenu = Menu::Instance($strMenuName);
    $mainMenu = fipsite_getCache("mainmenu");
 
    $id = fipsite_getCurrentPageMenuID($strMenuName);
    if (!$id)     
        return '';
 

    $arrSubmenus = $mainMenu->getMenuById($id);
    $hasChildren = false;
   
    $menuid= $id;
    if (count($arrSubmenus->children)>0)
    {
        $strHTML .= fipsite_getSubMenuHtml($arrSubmenus, "sidebar-submenus-title-submenus");
        $hasChildren = true;
    } else
    {
        $menuid = $mainMenu->getMenuParentId($id);
        $arrMenus = $mainMenu->getMenuById($menuid);
        $strHTML .= fipsite_getSubMenuHtml($arrMenus, "sidebar-submenus-title-submenus");
    }
    
    $strParentID = $mainMenu->getMenuParentId($menuid);
    
    if ($strParentID != $menuid)
    {
        $arrMenus = $mainMenu->getMenuById($strParentID);        
        $strHTML .= fipsite_getSubMenuHtml($arrMenus, "sidebar-submenus-title-siblings", "");//Related Content: ");
        
    }
    return $strHTML;
    
}

function fipsite_getCurrentPageMenuID ($strMenuName=null)
{
    global $post;
    $menu = wp_get_nav_menu_items($strMenuName,array(
        'posts_per_page' => -1,
        'meta_key' => '_menu_item_object_id',
        'meta_value' => $post->ID // the currently displayed post
    ));

    if (count($menu)>0)
        return $menu[0]->ID;
    return false;
}


function fipsite_getSubMenuHtml ($arrMenus, $strExtraClass, $strTitle='')
{
    if (empty($arrMenus->children) || count($arrMenus->children)==0)
        return '';
    $strContent = '';
    $strContent .= <<< LINK_HEADER
    <div class="side-links green sidebar-submenus">
    <header class="siderbar-submenus-title {$strExtraClass}">
    {$strTitle}{$arrMenus->title}
    </header>
    <ul class="side-links-menu">
LINK_HEADER;
    
    foreach ($arrMenus->children as $arrMenu)
    {
        $id = $arrMenu->object_id ;
        $menuid = $arrMenu->ID;
        $strActive = ($id == get_the_ID()) ? 'active' : '';
             
        $strContent .= <<< LINK_ITEM
        <li>
            <a class="sliderbar-submenu-link {$strActive}" href="{$arrMenu->url}" id="sliderbar-submenu-link-$id">{$arrMenu->title}</a>
        </li>
LINK_ITEM;
    }
    $strContent .= <<< LINK_FOOTER
        </ul>
    </div>
LINK_FOOTER;
    return $strContent;
}

