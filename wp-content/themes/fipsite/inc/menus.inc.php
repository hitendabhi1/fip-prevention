<?php
// Exit if accessed directly
defined('ABSPATH') || exit();

/*
 * Helper class to display menu items in a hierarchical array
 * Usage: $mainMenu = new Menu('primary');
 * $menuItems = $mainMenu->getTree();
 * $menuItems = $mainMenu->getMenuItems();
 */
final class Menu
{

    protected $menu;

    protected $tree;

    protected $_menuList;

    public static function Instance($strName)
    {
        static $inst = null;
        if ($inst === null) {
            $inst = new Menu($strName);
        }
        return $inst;
    }

    /**
     * Initialises $this->menu
     */
    public function __construct($menuName = '', $args = array(), $filter = null)
    {
        $filter = is_callable($filter) ? $filter : null;
        if (empty($menuName)) {
            throw new Exception('No menu location name provided.');
            return;
        }
        $this->menu = wp_get_nav_menu_items($menuName, $args);
        $this->getTree();
    }

    /**
     * Returns $this->menu
     */
    public function getMenuItems()
    {
        return $this->menu;
    }

    public function &getMenuList()
    {
        $tree = $this->getTree();
        return $this->_menuList;
    }

    public function getMenuById($id)
    {
        $list = $this->getMenuList();
        if (! empty($list[$id]))
            return $list[$id];
        return null;
    }

    public function getMenuParentId($id)
    {
        $objMenu = $this->getMenuById($id);
        if ($objMenu != null)
            return $objMenu->menu_item_parent;
        return - 1;
    }

    /**
     * Returns $this->tree
     *
     * @return Array|null $tree
     */
    public function getTree()
    {
        if ($this->tree !== null)
            return $this->tree;
        $this->_menuList = array();
        $tree = static::buildTree($this->menu, 0, 1, $this->_menuList);
        $this->tree = $tree;
        return $this->tree;
    }

    /**
     * Transform a navigational menu to a tree structure
     *
     * @return Array $branch
     */
    public static function buildTree(array &$elements, $parentId = 0, $level = 1, &$menuList)
    {
        $branch = array();
        foreach ($elements as &$element) {
            if (! is_user_logged_in() && get_post_status($element->object_id) != "publish")
                continue;
            if ($element->menu_item_parent == $parentId) {
                $classes = $element->classes;
                if (! empty($classes) && $classes == 'hidemenu')
                    continue;
                $subLevel = $level + 1;
                $element->level = $level;
                $children = static::buildTree($elements, $element->ID, $subLevel, $menuList);
                
                if ($children) {
                    $element->children = $children;
                } else {
                    $element->children = array();
                }
                
                if ($element->level == 1 && $element->url = '#' && count($children) > 0) {
                    $element->url = _findFirstRealUrl($children);
                }
                $element->categorytype = (! empty($classes) && $classes == 'spotlight') ? 'spotlight' : '';
                
                $branch[$element->ID] = $element;
                $menuList[$element->ID] = $element;
                
                unset($element);
            }
        }
        return $branch;
    }

    /**
     * Checks if menu item is a custom post type archive
     *
     * @return Boolean
     */
    protected static function menuItemIsCustomPostTypeArchive($menuItem, $type = null)
    {
        $isCustomPostType = (isset($menuItem->type) && ($menuItem->type === 'post_type_archive') && (is_post_type_archive($this->queriedPostType) || is_singular($this->queriedPostType)));
        if (! $type) {
            return $isCustomPostType;
        }
        $isOfType = ($isCustomPostType && isset($menuItem->object) && ($menuItem->object === $type));
        
        return $isOfType;
    }

    /**
     * Returns maximum depth of menu tree
     *
     * @return Integer
     */
    public static function menuItemDepth($menuItem = null)
    {
        $maxDepth = 0;
        foreach ($menuItem->children as $child) {
            if (is_array($child->children)) {
                $depth = static::menuItemDepth($child) + 1;
                if ($depth > $maxDepth)
                    $maxDepth = $depth;
            }
        }
        return $maxDepth;
    }
}

function _findFirstRealUrl($arrChildren)
{
    $strUrl = "#";
    foreach ($arrChildren as $arrChild) {
        if ($arrChild->url != "#") {
            return $arrChild->url;
        }
    }
    return $strUrl;
}