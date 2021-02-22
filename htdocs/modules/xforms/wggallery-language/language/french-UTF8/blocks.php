<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * wgGallery module for xoops
 *
 * @copyright      module for xoops
 * @license        GPL 2.0 or later
 * @package        wggallery
 * @since          1.0
 * @min_xoops      2.5.9
 * @author         Wedega - Email:<webmaster@wedega.com> - Website:<https://wedega.com>
 * @version        $Id: 1.0 blocks.php 1 Mon 2018-03-19 10:04:53Z XOOPS Project (www.xoops.org) $
 */
// Admin Edit
define ('_MB_WGGALLERY_BLOCKTYPE', 'Type de bloc');
define ('_MB_WGGALLERY_BLOCKTYPE_DEFAULT', 'Par défaut (trié par date décroissante)');
define ('_MB_WGGALLERY_BLOCKTYPE_RECENT', 'Articles récents');
define ('_MB_WGGALLERY_BLOCKTYPE_RANDOM', 'Articles aléatoires');
define ('_MB_WGGALLERY_TITLE_SHOW', 'Afficher le titre');
define ('_MB_WGGALLERY_TITLE_LENGTH', 'Longueur du titre (0 signifie pas de limite)');
define ('_MB_WGGALLERY_DESC_SHOW', 'Afficher la description');
define ('_MB_WGGALLERY_DESC_LENGTH', 'Longueur de la description (0 signifie pas de limite)');
define ('_MB_WGGALLERY_SHOW', 'Action après avoir cliqué sur l\'album');
define ('_MB_WGGALLERY_SHOW_GALLERY', 'Afficher la galerie (si un type de galerie est sélectionné)');
define ('_MB_WGGALLERY_SHOW_INDEX', 'Afficher la page d\'index');
define ('_MB_WGGALLERY_NUMB_ALBUMS', 'Nombre d\'albums à afficher sur chaque ligne');
define ('_MB_WGGALLERY_ALBUMS_DISPLAYLIST', 'Combien d\'albums à charger pour la liste d\'affichage');
define ('_MB_WGGALLERY_ALBUMS_TO_DISPLAY', 'Albums à afficher');
define ('_MB_WGGALLERY_ALL_ALBUMS', "Tous les albums avec l'état 'en ligne'");
define ('_MB_WGGALLERY_IMAGES_DISPLAYLIST', 'Combien d\'images charger pour la liste d\'affichage');
define ('_MB_WGGALLERY_ALBUMTYPES', 'Utiliser le type d\'album suivant pour l\'affichage');
define ('_MB_WGGALLERY_ALBUMTYPES_PRIMARY', 'Utiliser le type d\'album principal');
define ('_MB_WGGALLERY_ALBUMTYPES_OTHER', "Indépendant du type d'album principal, utilisez le type d'album '%s'");
define ('_MB_WGGALLERY_NUMB_IMAGES', 'Nombre d\'images à afficher dans chaque ligne');


// JJDai - block xbootstrap
define('_MB_WGGALLERY_XBOOTSTRAP_ALL_ALBUMS', 'Tous les albums');
define('_MB_WGGALLERY_XBOOTSTRAP_TITLE_MAINMENU', 'Albums photos');
define('_MB_WGGALLERY_XBOOTSTRAP_TITLE_SUBMENU', 'Albums photos');
define('_MB_WGGALLERY_XBOOTSTRAP_SEARCH_IMG', 'Recherche d\'image');
define('_MB_WGGALLERY_XBOOTSTRAP_NEW_ALBUM', 'Créer un nouvel album');
define('_MB_WGGALLERY_XBOOTSTRAP_MANAGE_ALBUMS', 'Gestion des albums');
