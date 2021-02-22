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
 * @version        $Id: 1.0 modinfo.php 1 Mon 2018-03-19 10:04:52Z XOOPS Project (www.xoops.org) $
 */
require_once __DIR__ . '/common.php';

// ---------------- Admin Principal ----------------
define ('_MI_WGGALLERY_NAME', 'wgGallery');
define ('_MI_WGGALLERY_DESC', 'Ce module est une galerie d\'images pour XOOPS');
// ---------------- Menu Admin ----------------
define ('_MI_WGGALLERY_ADMENU1', 'Tableau de bord');
define ('_MI_WGGALLERY_ADMENU2', 'Albums');
define ('_MI_WGGALLERY_ADMENU3', 'Images');
define ('_MI_WGGALLERY_ADMENU4', 'Types de galerie');
define ('_MI_WGGALLERY_ADMENU5', 'Types d\'album');
define ('_MI_WGGALLERY_ADMENU7', 'Autorisations');
define ('_MI_WGGALLERY_ADMENU8', 'Maintenance');
define ('_MI_WGGALLERY_ADMENU9', 'Filigranes');
define ('_MI_WGGALLERY_ADMENU10', 'Importer');
define ('_MI_WGGALLERY_ADMENU11', 'CatÃ©gories');
define ('_MI_WGGALLERY_FEEDBACK', 'Commentaires');
define ('_MI_WGGALLERY_ABOUT', 'Ã€ propos de');
// ---------------- Nav Admin ----------------
define ('_MI_WGGALLERY_ADMIN_PAGER', 'Liste des pages d\'administration des Ã©lÃ©ments');
define ('_MI_WGGALLERY_ADMIN_PAGER_DESC', 'DÃ©finir le nombre d\'Ã©lÃ©ments de liste dans la zone d\'administration');
// Utilisateur
define ('_MI_WGGALLERY_USER_PAGER', 'Liste des pages utilisateur des Ã©lÃ©ments');
define ('_MI_WGGALLERY_USER_PAGER_DESC', 'DÃ©finir le nombre d\'Ã©lÃ©ments de liste dans la zone utilisateur');
// Sous-menu
define ('_MI_WGGALLERY_SMNAME1', 'Page d\'index');
define ('_MI_WGGALLERY_SMNAME2', 'Gestion des albums');
define ('_MI_WGGALLERY_SMNAME3', 'CrÃ©er un nouvel album');
define ('_MI_WGGALLERY_SMNAME4', 'TÃ©lÃ©chargement d\'images');
define ('_MI_WGGALLERY_SMNAME5', 'Gestion des images');
define ('_MI_WGGALLERY_SMNAME6', 'Rechercher des images');
// Blocs
define ('_MI_WGGALLERY_ALBUMS_BLOCK', 'Bloc Albums');
define ('_MI_WGGALLERY_ALBUMS_BLOCK_DESC', 'Afficher un bloc avec des albums (le tri peut Ãªtre sÃ©lectionnÃ©)');
define ('_MI_WGGALLERY_IMAGES_BLOCK', 'Bloc d\'images');
define ('_MI_WGGALLERY_IMAGES_BLOCK_DESC', 'Afficher un bloc avec des images (le tri peut Ãªtre sÃ©lectionnÃ©)');
// Config
define ('_MI_WGGALLERY_EDITOR', 'Editeur de texte');
define ('_MI_WGGALLERY_EDITOR_DESC', 'SÃ©lectionnez l\'Ã©diteur Desc Ã  utiliser');
define ('_MI_WGGALLERY_KEYWORDS', 'Mots clÃ©s');
define ('_MI_WGGALLERY_KEYWORDS_DESC', 'InsÃ©rez ici les mots-clÃ©s (sÃ©parÃ©s par une virgule)');
define ('_MI_WGGALLERY_SIZE_MB', 'MB');
define ('_MI_WGGALLERY_MAXSIZE', 'Taille maximum');
define ('_MI_WGGALLERY_MAXSIZE_DESC', 'DÃ©finir la taille de fichier maximale pour les fichiers tÃ©lÃ©chargÃ©s');
define ('_MI_WGGALLERY_FILEEXT', 'Extension de fichier autorisÃ©e');
define ('_MI_WGGALLERY_FILEEXT_DESC', 'DÃ©finir l\'extension de fichier autorisÃ©e pour le tÃ©lÃ©chargement');
define ('_MI_WGGALLERY_MAXWIDTH', 'TÃ©lÃ©chargement de largeur maximum');
define ('_MI_WGGALLERY_MAXWIDTH_DESC', 'DÃ©finit la largeur maximale autorisÃ©e pour le tÃ©lÃ©chargement d\'images (en pixel)');
define ('_MI_WGGALLERY_MAXHEIGHT', 'Hauteur maximale de tÃ©lÃ©chargement');
define ('_MI_WGGALLERY_MAXHEIGHT_DESC', 'DÃ©finissez la hauteur maximale autorisÃ©e pour le tÃ©lÃ©chargement des images (en pixels)');
define ('_MI_WGGALLERY_MAXWIDTH_LARGE', 'Grande image de largeur maximale');
define ('_MI_WGGALLERY_MAXWIDTH_LARGE_DESC', 'DÃ©finir la largeur maximale Ã  laquelle les images tÃ©lÃ©chargÃ©es doivent Ãªtre mises Ã  l\'Ã©chelle (en pixels) <br> 0 signifie que les grandes images conservent la taille d\'origine. <br> Si une image est plus petite que la valeur maximale, alors l\'image ne sera pas agrandi, il sera sauvegardÃ© dans sa taille originale. ');
define ('_MI_WGGALLERY_MAXHEIGHT_LARGE', 'Hauteur maximale de la grande image');
define ('_MI_WGGALLERY_MAXHEIGHT_LARGE_DESC', 'DÃ©finir la hauteur maximale Ã  laquelle les images tÃ©lÃ©chargÃ©es doivent Ãªtre mises Ã  l\'Ã©chelle (en pixels) <br> 0 signifie que les grandes images conservent la taille d\'origine. <br> Si une image est plus petite que la valeur maximale, l\'image ne sera pas agrandi, il sera sauvegardÃ© dans sa taille originale. ');
define ('_MI_WGGALLERY_MAXWIDTH_MEDIUM', 'Image moyenne de largeur maximale');
define ('_MI_WGGALLERY_MAXWIDTH_MEDIUM_DESC', 'DÃ©finit la largeur maximale Ã  laquelle les images tÃ©lÃ©chargÃ©es seront mises Ã  l\'Ã©chelle pour une image moyenne (en pixels) <br> Si l\'image grande / originale est plus petite, l\'image ne sera pas agrandie (la grande image sera copiÃ©e comme moyenne) ');
define ('_MI_WGGALLERY_MAXHEIGHT_MEDIUM', 'Image moyenne de hauteur maximale');
define ('_MI_WGGALLERY_MAXHEIGHT_MEDIUM_DESC', 'DÃ©finit la hauteur maximale Ã  laquelle les images tÃ©lÃ©chargÃ©es doivent Ãªtre mises Ã  l\'Ã©chelle pour une image moyenne (en pixels) <br> Si l\'image grande / originale est plus petite, l\'image ne sera pas agrandie (la grande image sera copiÃ©e comme moyenne) ');
define ('_MI_WGGALLERY_MAXWIDTH_THUMBS', 'Largeur maximale des vignettes');
define ('_MI_WGGALLERY_MAXWIDTH_THUMBS_DESC', 'DÃ©finit la largeur maximale Ã  laquelle les images tÃ©lÃ©chargÃ©es seront mises Ã  l\'Ã©chelle pour les vignettes (en pixels)');
define ('_MI_WGGALLERY_MAXHEIGHT_THUMBS', 'Hauteur maximale des vignettes');
define ('_MI_WGGALLERY_MAXHEIGHT_THUMBS_DESC', 'DÃ©finit la hauteur maximale Ã  laquelle les images tÃ©lÃ©chargÃ©es doivent Ãªtre mises Ã  l\'Ã©chelle pour les vignettes (en pixels)');
define ('_MI_WGGALLERY_MAXWIDTH_ALBIMAGE', 'Images d\'album de largeur maximale');
define ('_MI_WGGALLERY_MAXWIDTH_ALBIMAGE_DESC', 'DÃ©finit la largeur maximale Ã  laquelle les images tÃ©lÃ©chargÃ©es seront redimensionnÃ©es pour les images d\'album (en pixels) <br> Si vous utilisez une image de l\'album lui-mÃªme, cette option n\'a aucun effet');
define ('_MI_WGGALLERY_MAXHEIGHT_ALBIMAGE', 'Images d\'album de hauteur maximale');
define ('_MI_WGGALLERY_MAXHEIGHT_ALBIMAGE_DESC', 'DÃ©finit la hauteur maximale Ã  laquelle les images tÃ©lÃ©chargÃ©es doivent Ãªtre mises Ã  l\'Ã©chelle pour les images d\'album (en pixels) <br> Si vous utilisez une image de l\'album lui-mÃªme, cette option n\'a aucun effet');
define ('_MI_WGGALLERY_GALLERY_TARGET', 'Cible pour la galerie');
define ('_MI_WGGALLERY_GALLERY_TARGET_DESC', 'Veuillez sÃ©lectionner oÃ¹ une galerie doit Ãªtre ouverte');
define ('_MI_WGGALLERY_LINK_TARGET_SELF', 'MÃªme fenÃªtre / onglet');
define ('_MI_WGGALLERY_LINK_TARGET_BLANK', 'Nouvelle fenÃªtre / onglet');
define ('_MI_WGGALLERY_IMAGE_TARGET', 'Cible pour une seule image');
define ('_ _MI_WGGALLERY_IMAGE_TARGET_DESC', 'Veuillez sÃ©lectionner oÃ¹ une seule image doit Ãªtre affichÃ©e');
define ('_MI_WGGALLERY_LINK_TARGET_MODAL', 'Afficher l\'image comme modale sans informations');
define ('_MI_WGGALLERY_LINK_TARGET_MODALINFO', 'Afficher l\'image comme modale avec des informations dÃ©taillÃ©es sur l\'image');
define ('_MI_WGGALLERY_ADDJQUERY', 'Ajouter une bibliothÃ¨que jquery');
define ('_MI_WGGALLERY_ADDJQUERY_DESC', 'Si vous utilisez dÃ©jÃ  jquery (par exemple dans votre thÃ¨me) alors rÃ©glez sur NO');
define ('_MI_WGGALLERY_PANEL_TYPE', 'Type de panneau');
define ('_MI_WGGALLERY_PANEL_TYPE_DESC', 'Le type de panneau est le div html de bootstrap.');
define ('_MI_WGGALLERY_SHOWBCRUMBS', 'Afficher le fil d\'Ariane');
define ('_MI_WGGALLERY_SHOWBCRUMBS_DESC', "La navigation avec fil d\'Ariane affiche le contexte de la page actuelle dans la structure du site.");
define ('_MI_WGGALLERY_SHOWBCRUMBS_MNAME', 'Afficher le nom du module');
define ('_MI_WGGALLERY_SHOWBCRUMBS_MNAME_DESC', 'Afficher le nom du module dans la navigation du fil d\'Ariane');
define ('_MI_WGGALLERY_SHOWCOPYRIGHT', 'Afficher les droits d\'auteur');
define ('_ _MI_WGGALLERY_SHOWCOPYRIGHT_DESC', 'Vous pouvez supprimer le copyright de la galerie, mais un backlinks vers www.wedega.com est attendu, n\'importe oÃ¹ sur votre site');
define ('_MI_WGGALLERY_USE_CATS', 'Utiliser des catÃ©gories');
define ('_MI_WGGALLERY_USE_CATS_DESC', 'DÃ©finissez si vous souhaitez utiliser des catÃ©gories pour les images et les albums');
define ('_MI_WGGALLERY_USE_TAGS', 'Utiliser les tags');
define ('_MI_WGGALLERY_USE_TAGS_DESC', 'DÃ©finissez si vous souhaitez utiliser des balises pour les images et les albums');
define ('_MI_WGGALLERY_STOREEXIF', 'Sauvegarder les meta data (exif)');
define ('_MI_WGGALLERY_STOREEXIF_DESC', 'DÃ©finissez si vous voulez enregistrer les mÃ©tadonnÃ©es (exif) des images');
define ('_MI_WGGALLERY_EXIFTYPES', 'DonnÃ©es Exif Ã  afficher');
define ('_MI_WGGALLERY_EXIFTYPES_DESC', "DÃ©finir quelles donnÃ©es exif doivent Ãªtre affichÃ©es <br> L'option '". _MI_WGGALLERY_STOREEXIF. "' doit Ãªtre activÃ©e");
define ('_MI_WGGALLERY_EXIF_TAGS', 'Extraire les balises de exif');
define ('_MI_WGGALLERY_EXIF_TAGS_DESC', "DÃ©finir quelles donnÃ©es exif doivent Ãªtre automatiquement extraites de exif et ajoutÃ©es Ã  une image sous forme de balise <br> L'option '". _MI_WGGALLERY_USE_TAGS. "' doit Ãªtre activÃ©e");
define ('_MI_WGGALLERY_SHOWBUTTONTEXT', 'Afficher le texte du bouton');
define ('_MI_WGGALLERY_SHOWBUTTONTEXT_DESC', 'Afficher le texte du bouton. Si NON, seules les images sont affichÃ©es');
define ('_MI_WGGALLERY_GROUP_UPLOAD', 'Options de tÃ©lÃ©chargement d\'images');
define ('_MI_WGGALLERY_GROUP_IMAGE', 'Options de traitement d\'image');
define ('_MI_WGGALLERY_GROUP_DISPLAY', 'Options d\'affichage');
define ('_MI_WGGALLERY_GROUP_MISC', 'Autres options');

// Notifications
define ('_MI_WGGALLERY_GLOBAL_NOTIFY', 'Notification globale');
define ('_MI_WGGALLERY_GLOBAL_ALB_NEW_ALL_NOTIFY', 'Envoyer une notification lors de la crÃ©ation d\'un nouvel album');
define ('_MI_WGGALLERY_GLOBAL_ALB_NEW_ALL_NOTIFY_CAPTION', 'M\'avertir pour le nouvel album');
define ('_MI_WGGALLERY_GLOBAL_ALB_NEW_ALL_NOTIFY_SUBJECT', 'Notification d\'un nouvel album');
define ('_MI_WGGALLERY_GLOBAL_ALB_MODIFY_ALL_NOTIFY', 'Envoyer une notification lorsqu\'un album a Ã©tÃ© modifiÃ©');
define ('_MI_WGGALLERY_GLOBAL_ALB_MODIFY_ALL_NOTIFY_CAPTION', 'M\'avertir de toute modification d\'album');
define ('_MI_WGGALLERY_GLOBAL_ALB_MODIFY_ALL_NOTIFY_SUBJECT', 'Notification sur l\'album modifiÃ©');
define ('_MI_WGGALLERY_GLOBAL_ALB_APPROVE_ALL_NOTIFY', 'Envoyer une notification lorsqu\'un album est en attente d\'approbation');
define ('_MI_WGGALLERY_GLOBAL_ALB_APPROVE_ALL_NOTIFY_CAPTION', 'M\'avertir que l\'album est en attente d\'approbation');
define ('_MI_WGGALLERY_GLOBAL_ALB_APPROVE_ALL_NOTIFY_SUBJECT', 'La notification concernant un album est en attente d\'approbation');
define ('_MI_WGGALLERY_GLOBAL_ALB_DELETE_ALL_NOTIFY', 'Envoyer une notification lorsqu\'un album a Ã©tÃ© supprimÃ©');
define ('_MI_WGGALLERY_GLOBAL_ALB_DELETE_ALL_NOTIFY_CAPTION', 'M\'avertir de tout album supprimÃ©');
define ('_MI_WGGALLERY_GLOBAL_ALB_DELETE_ALL_NOTIFY_SUBJECT', 'Notification de tout album Ã  supprimer');
define ('_MI_WGGALLERY_GLOBAL_IMG_NEW_ALL_NOTIFY', 'Envoyer une notification quand une nouvelle image a Ã©tÃ© tÃ©lÃ©chargÃ©e');
define ('_MI_WGGALLERY_GLOBAL_IMG_NEW_ALL_NOTIFY_CAPTION', 'M\'avertir de toute nouvelle image');
define ('_MI_WGGALLERY_GLOBAL_IMG_NEW_ALL_NOTIFY_SUBJECT', 'Notification sur une nouvelle image');
define ('_MI_WGGALLERY_GLOBAL_IMG_DELETE_ALL_NOTIFY', 'Envoyer une notification lorsqu\'une image a Ã©tÃ© supprimÃ©e');
define ('_MI_WGGALLERY_GLOBAL_IMG_DELETE_ALL_NOTIFY_CAPTION', 'M\'avertir de la suppression d\'une image');
define ('_MI_WGGALLERY_GLOBAL_IMG_DELETE_ALL_NOTIFY_SUBJECT', 'Notification sur l\'image supprimÃ©e');
define ('_MI_WGGALLERY_ALBUMS_NOTIFY', 'Notification d\'albums');
define ('_MI_WGGALLERY_ALBUMS_ALB_MODIFY_NOTIFY', 'Envoyer une notification lorsque cet album a Ã©tÃ© modifiÃ©');
define ('_MI_WGGALLERY_ALBUMS_ALB_MODIFY_NOTIFY_CAPTION', 'M\'avertir de la modification de cet album');
define ('_MI_WGGALLERY_ALBUMS_ALB_MODIFY_NOTIFY_SUBJECT', 'Notification sur l\'album modifiÃ©');
define ('_MI_WGGALLERY_ALBUMS_ALB_DELETE_NOTIFY', 'Envoyer une notification lorsque cet album a Ã©tÃ© supprimÃ©');
define ('_MI_WGGALLERY_ALBUMS_ALB_DELETE_NOTIFY_CAPTION', 'M\'informer de la suppression de cet album');
define ('_MI_WGGALLERY_ALBUMS_ALB_DELETE_NOTIFY_SUBJECT', 'Notification sur l\'album supprimÃ©');
define ('_MI_WGGALLERY_ALBUMS_IMG_NEW_NOTIFY', 'Envoyer une notification quand une nouvelle image a Ã©tÃ© tÃ©lÃ©chargÃ©e dans cet album');
define ('_MI_WGGALLERY_ALBUMS_IMG_NEW_NOTIFY_CAPTION', 'M\'avertir de la nouvelle image de cet album');
define ('_MI_WGGALLERY_ALBUMS_IMG_NEW_NOTIFY_SUBJECT', 'Notification sur une nouvelle image');
define ('_MI_WGGALLERY_ALBUMS_IMG_APPROVE_NOTIFY', 'Envoyer une notification lorsqu\'une image est en attente d\'approbation');
define ('_MI_WGGALLERY_ALBUMS_IMG_APPROVE_NOTIFY_CAPTION', 'M\'avertir que l\'image est en attente d\'approbation');
define ('_MI_WGGALLERY_ALBUMS_IMG_APPROVE_NOTIFY_SUBJECT', 'La notification sur l\'image est en attente d\'approbation');
define ('_MI_WGGALLERY_ALBUMS_IMG_DELETE_NOTIFY', 'Envoyer une notification lorsqu\'une nouvelle image a Ã©tÃ© supprimÃ©e de cet album');
define ('_MI_WGGALLERY_ALBUMS_IMG_DELETE_NOTIFY_CAPTION', 'M\'avertir de la suppression de l\'image de cet album');
define ('_MI_WGGALLERY_ALBUMS_IMG_DELETE_NOTIFY_SUBJECT', 'Notification sur l\'image supprimÃ©e');

define ('_MI_WGGALLERY_GLOBAL_IMG_COMMENT_NOTIFY', 'M\'avertir des nouveaux commentaires d\'images');
define ('_MI_WGGALLERY_GLOBAL_IMG_COMMENT_NOTIFY_CAPTION', 'M\'avertir des commentaires sur les images');
define ('_MI_WGGALLERY_GLOBAL_IMG_COMMENT_NOTIFY_SUBJECT', 'Notification des commentaires pour une image');
define ('_MI_WGGALLERY_ALBUMS_IMG_COMMENT_NOTIFY', 'M\'avertir des nouveaux commentaires des images de cet album');
define ('_MI_WGGALLERY_ALBUMS_IMG_COMMENT_NOTIFY_CAPTION', 'M\'avertir des commentaires des images de cet album');
define ('_MI_WGGALLERY_ALBUMS_IMG_COMMENT_NOTIFY_SUBJECT', 'Notification de nouveau commentaire pour une image');
define ('_MI_WGGALLERY_IMAGES_NOTIFY', 'Notification d\'image');
define ('_MI_WGGALLERY_IMAGES_IMG_COMMENT_NOTIFY', 'M\'avertir des nouveaux commentaires pour cette image');
define ('_MI_WGGALLERY_IMAGES_IMG_COMMENT_NOTIFY_CAPTION', 'Me notifier des commentaires sur cette image');
define ('_MI_WGGALLERY_IMAGES_IMG_COMMENT_NOTIFY_SUBJECT', 'Notification de nouveau commentaire pour une image');

define ('_MI_WGGALLERY_RATINGBARS', 'Autoriser l\'Ã©valuation');
define ('_MI_WGGALLERY_RATINGBARS_DESC', 'DÃ©finir si la notation doit Ãªtre possible et quel type de notation doit Ãªtre utilisÃ©');
define ('_MI_WGGALLERY_RATINGBAR_GROUPS', 'Groupes avec droits de classification');
define ('_MI_WGGALLERY_RATINGBAR_GROUPS_DESC', 'DÃ©finir quels groupes doivent avoir le droit de noter');
define ('_MI_WGGALLERY_RATING_NONE', 'Ne pas utiliser de notation');
define ('_MI_WGGALLERY_RATING_5STARS', 'Rating avec 5 Ã©toiles');
define ('_MI_WGGALLERY_RATING_10STARS', 'Rating avec 10 Ã©toiles');
define ('_MI_WGGALLERY_RATING_LIKES', 'Ã‰valuation avec j\'aime');
define ('_MI_WGGALLERY_RATING_10NUM', 'Note avec 10 points');

define ('_MI_WGGALLERY_STORE_ORIGINAL', 'Stocker l\'image originale');
define ('_MI_WGGALLERY_STORE_ORIGINAL_DESC', 'DÃ©finissez, si vous voulez stocker l\'image originale.
                <br> Avantage: toutes les images peuvent Ãªtre reproduites ultÃ©rieurement, y compris les nouvelles traces d\'eau
                <br> InconvÃ©nient: l\'espace serveur utilisÃ© augmentera en fonction de la taille de fichier de tÃ©lÃ©chargement autorisÃ©e ');




//JJDai - Ajout du block xbootstrap
define ('_MI_WGGALLERY_XBOOTSTRAP_BLOCK', 'wggallery xbootstrap');
define ('_MI_WGGALLERY_XBOOTSTRAP_BLOCK_DESC', 'exemple d\'intÃ©gration dans le thÃ¨me : bid=###|0|127|1|1|1|1|1|1');


