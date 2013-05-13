<?php
/*
 +-----------------------------------------------------------------------------+
 | File Path = "core/helper/CssGenerator.php"                                  |
 |                                                                             |
 | This file is part of Inpress Wordpress Theme                                |
 | Copyright (C) 2013, YouCode Web Studio                                      |
 |                                                                             |
 | CONTENTS:                                                                   |
 |   Class used for the css generation                                         |
 |                                                                             |
 |   THIS FILE IS REQUIRED FOR THEME RUNNING                                   |
 +-----------------------------------------------------------------------------+
 | Author: YouCode Web Studio - Zakaria Sahnoune <zakaria.sahnoune@gmail.com>  |
 | Author URL: http://themeforest.net/user/youcode                             |
 +-----------------------------------------------------------------------------+
*/


class CssGenerator {

    /**
     * Constructor
     *
     */
    function CssGenerator()
    {
        // less CSS compiler
        require_once(THEME_PLUGINS.'/lessc.inc.php');

    }

    public function get_admin_css()
    {
        // bootstrap custom
    }


}