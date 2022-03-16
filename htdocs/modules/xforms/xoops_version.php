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
 * @package   \XoopsModules\Xforms\init
 * @author    Brandycoke Productions
 * @author    Dylian Melgert
 * @author    Juan Garcés
 * @author    XOOPS Module Development Team
 * @copyright Copyright (c) 2001-2019 {@link https://xoops.org XOOPS Project}
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 * @since     1.00
 */
use XoopsModules\Xforms\Constants;

defined('XOOPS_ROOT_PATH') || exit('Restricted access');

require_once __DIR__ . '/preloads/autoloader.php';

$moduleDirName = basename(__DIR__);
//include_once (XOOPS_ROOT_PATH . "/modules/{$moduleDirName}/include/functions.php");

/*  @var array $modversion */
$modversion['version']        = '2.12';
$modversion['module_status']  = 'Alpha 1';
$modversion['release_date']   = '2022/06/19';
$modversion['name']           = _MI_XFORMS_NAME;
$modversion['description']    = _MI_XFORMS_DESC;
$modversion['author']         = 'Brandycoke Productions, Dylian Melgert, Juan Garcés, Jean-Jacques Delalandre(JJDai)';
$modversion['credits']        = 'XOOPS Development Team: Black_beard, Cesag, Philou, Mamba, ZySpec, JJDai';
$modversion['license']        = 'GNU GPL 2.0 or later';
$modversion['license_url']    = 'www.gnu.org/licenses/gpl-2.0.html';
$modversion['official']       = 0;
$modversion['image']          = 'assets/images/logoModule.png';
$modversion['dirname']        = $moduleDirName;

$modversion['author_mail']          = 'jjdelalandre@orange.fr';
$modversion['author_website_url']   = 'http://jubile.fr';
$modversion['author_website_name']  = 'Origami';
$modversion['release_info']         = '';
$modversion['release_file']         = '';
$modversion['description']          = '';



//$modversion['dirmoduleadmin'] = '/Frameworks/moduleclasses/moduleadmin';
//$modversion['icons16']        = '../../Frameworks/moduleclasses/icons/16';
//$modversion['icons32']        = '../../Frameworks/moduleclasses/icons/32';

// Help file(s)
$modversion['help']           = 'page=help';
$modversion['helpsection'] = array(array('name' => _MI_XFORMS_HELP_OVERVIEW,
                                         'link' => 'page=help'),
                                   array('name' => _MI_XFORMS_IMPORT,
                                         'link' => 'page=import'),
                                   array('name' => _MI_XFORMS_HELP_ELEMENTS,
                                         'link' => 'page=form_elements'),
                                   array('name' => _MI_XFORMS_HELP_ISSUES,
                                         'link' => 'page=issues')
);

//About
$modversion['module_website_url']  = 'https://xoops.org/';
$modversion['module_website_name'] = 'XOOPS';
$modversion['min_php']             = '5.6';
$modversion['min_xoops']           = '2.5.9';
$modversion['min_admin']           = '1.2';
$modversion['min_db']              = array('mysql' => '5.5', 'mysqli' => '5.5');

// Install, update, unistall
$modversion['onInstall']   = 'include/oninstall.php';
$modversion['onUpdate']    = 'include/onupdate.php';
$modversion['onUninstall'] = 'include/onuninstall.php';

// Sql file (must contain sql generated by phpMyAdmin)
// All tables should not have any prefix!
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';

// Tables created by sql file (without prefix!)
$modversion['tables'][0] = 'xforms_form';
$modversion['tables'][1] = 'xforms_element';
$modversion['tables'][2] = 'xforms_userdata';
$modversion['tables'][3] = 'xforms_userform';
$modversion['tables'][4] = 'xforms_banish';

// Admin things
$modversion['hasAdmin']   = 1;
$modversion['adminindex']  = 'admin/index.php';
$modversion['adminmenu']   = 'admin/menu.php';

// Menu content in main menu block
$modversion['hasMain'] = 1;

// Display main menu (1 = true)
$modversion['system_menu'] = 1;

// Templates
$modversion['templates']= array (array('file'        => 'xforms_index.tpl',
                                       'description' => _MI_XFORMS_TMPL_MAIN_DESC),
                                 array('file'        => 'xforms_form.tpl',
                                       'description' => _MI_XFORMS_TMPL_FORM_DESC),
                                 array('file'        => 'xforms_form_poll.tpl',
                                       'description' => _MI_XFORMS_TMPL_POLL_DESC),
                                 array('file'        => 'xforms_error.tpl',
                                       'description' => _MI_XFORMS_TMPL_ERROR_DESC),
                                 array('file'        => 'admin/xforms_contact-list.tpl',
                                       'description' => 'Liste des messages'),
                                 array('file'        => 'admin/xforms_banish-list.tpl',
                                       'description' => 'Liste des email bannis'),
                                 array('file'        => 'admin/xforms_forms-list.tpl',
                                       'description' => 'Liste des formulaires de contact'),
                                 array('file'        => 'admin/xforms_about.tpl',
                                       'description' => 'A propos')
);

/*
 * Search definitions
 * 1 = yes, module has search | 0 = no
 */
$modversion['hasSearch'] = 1;
$modversion['search'] = array('file' => 'include/search.inc.php',
                              'func' => 'xforms_search');

// Blocks
$modversion['blocks']= array (array('file' => 'list_block.php',
                                    'name' => _MI_XFORMS_BLK_LIST,
                             'description' => _MI_XFORMS_BLK_LIST_DESC,
                               'show_func' => 'b_xforms_list_show',
                               'edit_func' => 'b_xforms_list_edit',
                                 'options' => 'weight|5',
                                'template' => 'xforms_blk_list.tpl'),

                              array('file' => 'form_block.php',
                                    'name' => _MI_XFORMS_BLK_FORM,
                             'description' => _MI_XFORMS_BLK_FORM_DESC,
                               'show_func' => 'b_xforms_form_show',
                               'edit_func' => 'b_xforms_form_edit',
                                 'options' => '1',
                                'template' => 'xforms_blk_form.tpl')
);

xoops_load('xoopslists');
//require_once $GLOBALS['xoops']->path('www/modules/' . $moduleDirName . '/class/constants.php');
xoops_load('XoopsEditorHandler');
$editorHandler = \XoopsEditorHandler::getInstance();
$editorList    = array_flip($editorHandler->getList());


/* Module Configs */
$modversion['config'] = array(
                              array('name' => 'editorAdmin',
                                   'title' => '_MI_XFORMS_EDITOR_ADMIN',
                             'description' => '_MI_XFORMS_EDITOR_ADMIN_DESC',
                                'formtype' => 'select',
                               'valuetype' => 'text',
                                 'options' => $editorList,
                                 'default' => '35'),

                              array('name' => 't_width',
                                   'title' => '_MI_XFORMS_TEXT_WIDTH',
                             'description' => '',
                                'formtype' => 'textbox',
                               'valuetype' => 'int',
                                 'default' => '35'),

                              array('name' => 't_max',
                                   'title' => '_MI_XFORMS_TEXT_MAX',
                             'description' => '',
                                'formtype' => 'textbox',
                               'valuetype' => 'int',
                                 'default' => '255'),

                              array('name' => 'ta_rows',
                                   'title' => '_MI_XFORMS_TEXTAREA_ROWS',
                             'description' => '',
                                'formtype' => 'textbox',
                               'valuetype' => 'int',
                                 'default' => '5'),

                              array('name' => 'ta_cols',
                                   'title' => '_MI_XFORMS_TEXTAREA_COLS',
                             'description' => '',
                                'formtype' => 'textbox',
                               'valuetype' => 'int',
                                 'default' => '35'),

                              array('name' => 'moreinfo',
                                   'title' => '_MI_XFORMS_MOREINFO',
                             'description' => '',
                                'formtype' => 'select_multi',
                               'valuetype' => 'array',
                                 'default' => array('user', 'ip', 'agent'),
                                 'options' => array(_MI_XFORMS_MOREINFO_USER => 'user', _MI_XFORMS_MOREINFO_IP => 'ip', _MI_XFORMS_MOREINFO_AGENT => 'agent', _MI_XFORMS_MOREINFO_FORM => 'form')),

                              array('name' => 'mycountry',
                                   'title' => '_MI_XFORMS_ELE_SELECT_CTRY_DEFAULT',
                             'description' => '',
                                'formtype' => 'select',
                               'valuetype' => 'text',
                                 'default' => '-----',
                                 'options' => array_flip(XoopsLists::getCountryList())),

                              array('name' => 'mail_charset',
                                   'title' => '_MI_XFORMS_MAIL_CHARSET',
                             'description' => '_MI_XFORMS_MAIL_CHARSET_DESC',
                                'formtype' => 'textbox',
                               'valuetype' => 'text',
                                 'default' => _CHARSET),

                              array('name' => 'prefix',
                                   'title' => '_MI_XFORMS_PREFIX',
                             'description' => '',
                                'formtype' => 'textbox',
                               'valuetype' => 'text',
                                 'default' => ''),

                              array('name' => 'suffix',
                                   'title' => '_MI_XFORMS_SUFFIX',
                             'description' => '',
                                'formtype' => 'textbox',
                               'valuetype' => 'text',
                                 'default' => ' <span style="color:red">*</span>'), // JJDai *

                              array('name' => 'dtitle',
                                   'title' => '_MI_XFORMS_DEFAULT_TITLE',
                             'description' => '',
                                'formtype' => 'textbox',
                               'valuetype' => 'text',
                                 'default' => _MI_XFORMS_DEFAULT_TITLE_DESC),

                              array('name' => 'intro',
                                   'title' => '_MI_XFORMS_INTRO',
                             'description' => '',
                                'formtype' => 'textarea',
                               'valuetype' => 'text',
                                 'default' => _MI_XFORMS_INTRO_DEFAULT),

                              array('name' => 'noform',
                                   'title' => '_MI_XFORMS_NOFORM',
                             'description' => '',
                                'formtype' => 'textarea',
                               'valuetype' => 'text',
                                 'default' => _MI_XFORMS_NOFORM_DEFAULT),

                              array('name' => 'global',
                                   'title' => '_MI_XFORMS_GLOBAL',
                             'description' => '',
                                'formtype' => 'textarea',
                               'valuetype' => 'text',
                                 'default' => _MI_XFORMS_GLOBAL_DEFAULT),

                              array('name' => 'uploaddir',
                                   'title' => '_MI_XFORMS_UPLOADDIR',
                             'description' => '_MI_XFORMS_UPLOADDIR_DESC',
                                'formtype' => 'textbox',
                               'valuetype' => 'text',
                                 'default' => XOOPS_UPLOAD_PATH . '/' . $moduleDirName),

                              array('name' => 'captcha',
                                   'title' => '_MI_XFORMS_CAPTCHA',
                             'description' => '_MI_XFORMS_CAPTCHA_DESC',
                                'formtype' => 'select',
                               'valuetype' => 'int',
                                 'options' => array(_MI_XFORMS_CAPTCHA_INHERIT => Constants::CAPTCHA_INHERIT,
                                                  _MI_XFORMS_CAPTCHA_ANON_ONLY => Constants::CAPTCHA_ANON_ONLY,
                                                   _MI_XFORMS_CAPTCHA_EVERYONE => Constants::CAPTCHA_EVERYONE,
                                                       _MI_XFORMS_CAPTCHA_NONE => Constants::CAPTCHA_NONE
                                              ),
                             'default'     => Constants::CAPTCHA_INHERIT),

                              array('name' => 'showforms',
                                   'title' => '_MI_XFORMS_SHOWFORMS',
                             'description' => '_MI_XFORMS_SHOWFORMS_DESC',
                                'formtype' => 'yesno',
                               'valuetype' => 'int',
                                 'default' => 1),

                              array('name' => 'perpage',
                                   'title' => '_MI_XFORMS_PERPAGE',
                             'description' => '_MI_XFORMS_PERPAGE_DESC',
                                'formtype' => 'textbox',
                               'valuetype' => 'int',
                                 'default' => Constants::FORMS_PER_PAGE_DEFAULT)
);
// JJDai

  $modversion['config'][] = ['name' => 'returnModeOnCaptchaErr',
                      'title'       => '_MI_XFORMS_CAPTCHA_MODE',
                      'description' => '',
                      'formtype'    => 'select',
                      'valuetype'   => 'int',
                      'default'     => 0,
                      'options'     => array(_MI_XFORMS_CAPTCHA_MODE0=>0, _MI_XFORMS_CAPTCHA_MODE1=>1 )];


//-------------------------------------------------------------

$modversion['config'][] = ['name' => 'css_folder',
                          'title' => '_MI_XFORMS_CSS_FOLDER',
                    'description' => '_MI_XFORMS_CSS_FOLDER_DESC',
                       'formtype' => 'textbox',
                      'valuetype' => 'text',
                        'default' => ''];
                        
$modversion['config'][] = ['name' => 'caution_for_banish',
                          'title' => '_MI_XFORMS_BANISH',
                    'description' => '_MI_XFORMS_BANISH_DESC',
                       'formtype' => 'textarea',
                      'valuetype' => 'text',
                        'default' => _MI_XFORMS_BANISH_DEFAULT];
                        
// $modversion['config'][] = ['name' => 'color_set',
//                           'title' => '_MI_XFORMS_COLOR_SET',
//                     'description' => '_MI_XFORMS_COLOR_SET_DESC',
//                        'formtype' => 'select',
//                       'valuetype' => 'text',
//                         'options' => Xforms\get_css_color(),
//                         'default' => ''];


$modversion['config'][] = ['name' => 'displayTemplateName',
                    'title'       => '_MI_XFORMS_SHOW_TPL_NAME',
                    'description' => '_MI_XFORMS_SHOW_TPL_NAME_DESC',
                    'formtype'    => 'yesno',
                    'valuetype'   => 'int',
                    'default'     => 0];
