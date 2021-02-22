<?php
/*
 You may not change or alter any portion of this comment or credits of
 supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit
 authors.

 This program is distributed in the hope that it will be useful, but
 WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */
/**
 * Module: xForms
 *
 * @package   \XoopsModules\Xforms\include
 * @author    Richard Griffith <richard@geekwright.com>
 * @author    trabis <lusopoemas@gmail.com>
 * @author    XOOPS Module Development Team
 * @copyright Copyright (c) 2001-2019 {@link https://xoops.org XOOPS Project}
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 * @since     2.00
 */

global $xoopsDB;

//---------------------------------------------------
  $tbl = $xoopsDB->prefix('xforms_userform');
  $sql = <<<__sql__
CREATE TABLE `{$tbl}` (
  `uform_id` mediumint(8) NOT NULL auto_increment,
  `form_id` smallint(5) NOT NULL,
  `uform_status` smallint(5) NOT NULL default '0',
  `uform_user` VARCHAR(80) NOT NULL  default '',
  `uform_email` varchar(50) NOT NULL default '',
  `uform_chrono` VARCHAR(50) NOT NULL  default '',
  `uform_object` VARCHAR(80) NOT NULL  default '',
  `uform_answer` text NOT NULL default '',
  PRIMARY KEY  (`uform_id`),
  KEY `uform_status` (`uform_status`)
) ENGINE=MyISAM;
__sql__;

  $xoopsDB->queryf($sql);

//---------------------------------------------------
  $sql = "ALTER TABLE " . $xoopsDB->prefix('xforms_form')
       . " ADD form_answer tinyint(1) NOT NULL default '0' AFTER form_display_style;";
  $xoopsDB->queryf($sql);
  //echo $sql . "<hr>";
//---------------------------------------------------
//   $sql = "ALTER TABLE " . $xoopsDB->prefix('xforms_element')
//        . " ADD `uform_id` mediumint(8) NOT NULL default '0';";
//   $xoopsDB->queryf($sql);
//---------------------------------------------------
  $sql = "ALTER TABLE " . $xoopsDB->prefix('xforms_userdata')
       . " ADD `uform_id` mediumint(8) NOT NULL default '0' AFTER udata_id,"
       . " ADD `udata_content` tinyint(1) NOT NULL default '0';";
  $xoopsDB->queryf($sql);
  //echo $sql . "<hr>";
//---------------------------------------------------

    return $success;

