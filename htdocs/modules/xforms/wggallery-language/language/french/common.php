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
 * @copyright module for xoops
 * @license   GPL 2.0 or later
 * @package   wggallery
 * @since     1.0
 * @min_xoops 2.5.7
 * @author    Wedega - Email:<webmaster@wedega.com> - Website:<https://wedega.com>
 * @version   $Id: 1.0 main.php 1 Mon 2018-03-19 10:04:56Z XOOPS Project (www.xoops.org) $
 */

// d&eacute;finit pour l\'&eacute;tat
define ('_CO_WGGALLERY_STATE_OFFLINE', 'Hors ligne');
define ('_CO_WGGALLERY_STATE_ONLINE', 'En ligne');
define ('_CO_WGGALLERY_STATE_APPROVAL', 'En attente d\'approbation');
// G&eacute;n&eacute;ral
define ('_CO_WGGALLERY_NONE', 'Aucun');
define ('_CO_WGGALLERY_BACK', 'Retour en arri&egrave;re');
define ('_CO_WGGALLERY_ALL', 'Tous');
define ('_CO_WGGALLERY_UPDATE', 'Mettre &agrave; jour');
define ('_CO_WGGALLERY_EXEC', 'Ex&eacute;cuter');
define ('_CO_WGGALLERY_DOWNLOAD', 't&eacute;l&eacute;charger');
define ('_CO_WGGALLERY_DOWNLOAD_ALB', 'T&eacute;l&eacute;charger l\'album');
define ('_CO_WGGALLERY_DATE', 'Date');
define ('_CO_WGGALLERY_SUBMITTER', 'Auteur-Autrice');
define ('_CO_WGGALLERY_WEIGHT', 'Poids');
define ('_CO_WGGALLERY_COMMENT', 'commentaire');
define ('_CO_WGGALLERY_COMMENTS', 'commentaires');
define ('_CO_WGGALLERY_VIEWS', 'Vues');
define ('_CO_WGGALLERY_RATING', '&Eacute;valuation');
// Formes
define ('_CO_WGGALLERY_FORM_UPLOAD', 'T&eacute;l&eacute;charger un fichier');
define ('_CO_WGGALLERY_FORM_IMAGE_PATH', 'Fichiers dans %s');
define ('_CO_WGGALLERY_FORM_ACTION', 'Action');
define ('_CO_WGGALLERY_FORM_EDIT', 'Modification');
define ('_CO_WGGALLERY_FORM_TOGGLE_SELECT', 'tout s&eacute;lectionner / tout d&eacute;s&eacute;lectionner');
define ('_CO_WGGALLERY_FORM_IMAGEPICKER', 'S&eacute;lectionnez une image');
define ('_CO_WGGALLERY_FORM_SUBMIT_SUBMITUPLOAD', 'Soumettre et t&eacute;l&eacute;charger les images');
define ('_CO_WGGALLERY_FORM_SUBMIT_WMTEST', 'Soumettre et afficher l\'image de test');
define ('_CO_WGGALLERY_FORM_ERROR_INVALIDID', 'Id invalide');
define ('_CO_WGGALLERY_FORM_OK', 'Enregistr&eacute; avec succ&egrave;s');
define ('_CO_WGGALLERY_FORM_DELETE_OK', 'Supprim&eacute; avec succ&egrave;s');
define ('_CO_WGGALLERY_FORM_SURE_DELETE', "&Ecirc;tes-vous s&ucirc;r de supprimer: <b> <span style = 'color: Red;'> %s </span> </b>"); // xoops par d&eacute;faut confirme
define ('_CO_WGGALLERY_FORM_SURE_RENEW', "&Ecirc;tes-vous s&ucirc;r de mettre &agrave; jour: <b> <span style = 'color: Red;'> %s </span> </b>");
define ('_CO_WGGALLERY_FORM_DELETE', 'Supprimer'); // wggallery xoops confirme
define ('_CO_WGGALLERY_FORM_DELETE_SURE', 'Voulez-vous vraiment supprimer?'); // wggallery xoops confirme
define ('_CO_WGGALLERY_FORM_ERROR_RESETUSAGE1', 'Erreur lors de la r&eacute;initialisation de l\'utilisation d\'un filigrane');
define ('_CO_WGGALLERY_FORM_ERROR_RESETUSAGE2', 'Erreur lors de la r&eacute;initialisation de l\'utilisation du filigrane dans les albums');
define ('_CO_WGGALLERY_FORM_ERROR_ALBPID', 'Erreur: albums parents introuvables');
define ('_CO_WGGALLERY_FORM_OK_APPROVE', 'Album enregistr&eacute; avec succ&egrave;s. Vous serez redirig&eacute; pour approuver les images');
// Il n\'y a pas
define ('_CO_WGGALLERY_THEREARENT_ALBUMS', 'Actuellement aucun album n\'est disponible');
define ('_CO_WGGALLERY_THEREARENT_IMAGES', 'Il n\'y a actuellement aucune image disponible');
// fine uploader
define ('_CO_WGGALLERY_FU_SUBMIT', 'Envoi de l image:');
define ('_CO_WGGALLERY_FU_SUBMITTED', 'Image v&eacute;rifi&eacute;e avec succ&egrave;s, veuillez t&eacute;l&eacute;charger');
define ('_CO_WGGALLERY_FU_UPLOAD', 'T&eacute;l&eacute;charger une image:');
define ('_CO_WGGALLERY_FU_FAILED', 'Erreurs survenues lors du t&eacute;l&eacute;chargement des images');
define ('_CO_WGGALLERY_FU_SUCCEEDED', 'T&eacute;l&eacute;versement r&eacute;ussi de toutes les images');
// Boutons d\'album
define ('_CO_WGGALLERY_ALBUM_ADD', 'Ajouter un album');
define ('_CO_WGGALLERY_ALBUM_EDIT', 'Modifier l\'album');
// &Eacute;l&eacute;ments de collections
define ('_CO_WGGALLERY_COLL_TITLE', 'Collections disponibles');
define ('_CO_WGGALLERY_COLL_ALBUMS', 'Afficher les sous-albums');
// &Eacute;l&eacute;ments de l\'album
define ('_CO_WGGALLERY_ALBUMS_TITLE', 'Galerie d\'albums');
define ('_CO_WGGALLERY_ALBUMS_COUNT', 'Nombre d\'albums');
define ('_CO_WGGALLERY_ALBUM', 'Album');
define ('_CO_WGGALLERY_ALBUMS', 'Albums');
define ('_CO_WGGALLERY_ALBUMS_DESC', 'wgGallery est un module XOOPS pour pr&eacute;senter des images dans des albums et des cat&eacute;gories');
define ('_CO_WGGALLERY_ALBUM_COLL', 'Collection');
define ('_CO_WGGALLERY_ALBUM_NB_COLL', 'album (s) de cette collection');
define ('_CO_WGGALLERY_ALBUM_NB_IMAGES', 'image (s) dans cet album');
define ('_CO_WGGALLERY_ALBUM_NO_IMAGES', 'L\'album ne contient aucune image');
define ('_CO_WGGALLERY_ALBUM_ID', 'Id');
define ('_CO_WGGALLERY_ALBUM_PID', 'Collection parent');
define ('_CO_WGGALLERY_ALBUM_ISCOLL', 'L\'album est une collection');
define ('_CO_WGGALLERY_ALBUM_NAME', 'Nom');
define ('_CO_WGGALLERY_ALBUM_DESC', 'Description');
define ('_CO_WGGALLERY_ALBUM_IMAGE', 'Image de l\'album');
define ('_CO_WGGALLERY_ALBUM_IMGTYPE', 'Source pour l\'image de l\'album');
define ('_CO_WGGALLERY_ALBUM_USE_EXIST', 'Utiliser une image d\'album comme image d\'album');
define ('_CO_WGGALLERY_ALBUM_IMGID', 'Images existantes dans cet album');
define ('_CO_WGGALLERY_ALBUM_USE_UPLOADED', 'Utiliser une image t&eacute;l&eacute;charg&eacute;e comme image de l\'album');
define ('_CO_WGGALLERY_ALBUM_CREATE_GRID', 'Cr&eacute;er une grille');
define ('_CO_WGGALLERY_ALBUM_CROP_IMAGE', 'Recadrer l\'image');
define ('_CO_WGGALLERY_ALBUM_FORM_UPLOAD_IMAGE', 'T&eacute;l&eacute;charger une nouvelle image');
define ('_CO_WGGALLERY_ALBUM_STATE', 'Etat');
define ('_CO_WGGALLERY_ALBUM_DELETE_DESC', 'Attention: Toutes les images li&eacute;es &agrave; cet album seront &eacute;galement supprim&eacute;es');
define ('_CO_WGGALLERY_ALBUM_SELECT', 'S&eacute;lectionner l\'album');
define ('_CO_WGGALLERY_ALBUM_SELECT_DESC', 'Veuillez s&eacute;lectionner l\'album pour t&eacute;l&eacute;charger les images');
define ('_CO_WGGALLERY_ALBUMS_SHOW', 'Afficher tous les albums');
define ('_CO_WGGALLERY_ALBUMS_SORT', 'Tri des albums');
define ('_CO_WGGALLERY_ALBUM_SORT_SHOWHIDE', 'Cliquez pour afficher / masquer les sous-&eacute;l&eacute;ments');
define ('_CO_WGGALLERY_ALBUM_IMAGE_ERRORNOTFOUND', 'Erreur: image de l\'album introuvable');
define ('_CO_WGGALLERY_ALBUMS_ERRNOTFOUND', 'Erreur: Image non trouv&eacute;e (Image-Id %s)');
// gestionnaire d\'images d\'album
define ('_CO_WGGALLERY_ALBUM_IH_APPLY', 'Appliquer');
define ('_CO_WGGALLERY_ALBUM_IH_IMAGE_EDIT', 'Modifier l\'image de l\'album');
define ('_CO_WGGALLERY_ALBUM_IH_CURRENT', 'Actuel');
define ('_CO_WGGALLERY_ALBUM_IH_GRID4', 'Utiliser 4 images');
define ('_CO_WGGALLERY_ALBUM_IH_GRID6', 'Utiliser 6 images');
define ('_CO_WGGALLERY_ALBUM_IH_GRID_SRC1', 'S&eacute;lectionner l\'image 1');
define ('_CO_WGGALLERY_ALBUM_IH_GRID_SRC2', 'S&eacute;lectionner l\'image 2');
define ('_CO_WGGALLERY_ALBUM_IH_GRID_SRC3', 'S&eacute;lectionner l\' image 3');
define ('_CO_WGGALLERY_ALBUM_IH_GRID_SRC4', 'S&eacute;lectionner l\'image 4');
define ('_CO_WGGALLERY_ALBUM_IH_GRID_SRC5', 'S&eacute;lectionner l\'image 5');
define ('_CO_WGGALLERY_ALBUM_IH_GRID_SRC6', 'S&eacute;lectionner l\' image 6');
define ('_CO_WGGALLERY_ALBUM_IH_GRID_CREATE', 'Cr&eacute;er une grille');
define ('_CO_WGGALLERY_ALBUM_IH_CROP_CREATE', 'Cr&eacute;er une image');
define ('_CO_WGGALLERY_ALBUM_IH_CROP_MOVE', 'D&eacute;placer');
define ('_CO_WGGALLERY_ALBUM_IH_CROP_ZOOMIN', 'Zoom avant');
define ('_CO_WGGALLERY_ALBUM_IH_CROP_ZOOMOUT', 'Zomm arri&egrave;re');
define ('_CO_WGGALLERY_ALBUM_IH_CROP_MOVE_LEFT', 'D&eacute;placer vers la gauche');
define ('_CO_WGGALLERY_ALBUM_IH_CROP_MOVE_RIGHT', 'D&eacute;placer vers la droite');
define ('_CO_WGGALLERY_ALBUM_IH_CROP_MOVE_UP', 'Remonter');
define ('_CO_WGGALLERY_ALBUM_IH_CROP_MOVE_DOWN', 'Descendre');
define ('_CO_WGGALLERY_ALBUM_IH_CROP_FLIP_HORIZONTAL', 'Miroir horizontal');
define ('_CO_WGGALLERY_ALBUM_IH_CROP_FLIP_VERTICAL', 'Miroir vertical');
define ('_CO_WGGALLERY_ALBUM_IH_CROP_ASPECTRATIO', 'Rapport hauteur / largeur');
define ('_CO_WGGALLERY_ALBUM_IH_CROP_ASPECTRATIO_FREE', 'Gratuit');
// Ajout / modification / affichage d\'image
define ('_CO_WGGALLERY_IMAGE_ADD', 'Ajouter une image');
define ('_CO_WGGALLERY_IMAGE_EDIT', 'Modifier l\'image');
define ('_CO_WGGALLERY_IMAGE_SHOW', 'Afficher l\'image');
// &Eacute;l&eacute;ments d\'image
define ('_CO_WGGALLERY_IMAGE', 'Image');
define ('_CO_WGGALLERY_IMAGES', 'Images');
define ('_CO_WGGALLERY_IMAGES_TITLE', 'Galerie d\'images de');
define ('_CO_WGGALLERY_IMAGES_COUNT', 'Nombre d\'images');
define ('_CO_WGGALLERY_IMAGES_ALBUMSHOW', 'Afficher l\'album');
define ('_CO_WGGALLERY_IMAGES_INDEX', 'Afficher l\'index des images');
define ('_CO_WGGALLERY_IMAGES_UPLOAD', 'T&eacute;l&eacute;charger des images');
define ('_CO_WGGALLERY_IMAGE_MANAGE', 'Gestion des images');
define ('_CO_WGGALLERY_IMAGE_MANAGE_DESC', 'Regroupez vos images par glisser-d&eacute;poser');
define ('_CO_WGGALLERY_IMAGE_ID', 'Id');
define ('_CO_WGGALLERY_IMAGE_TITLE', 'Titre');
define ('_CO_WGGALLERY_IMAGE_DESC', 'Description');
define ('_CO_WGGALLERY_IMAGE_NAME', 'Nom');
define ('_CO_WGGALLERY_IMAGE_NAMEORIG', 'Nom original');
define ('_CO_WGGALLERY_IMAGE_NAMELARGE', 'Nom de la grande image');
define ('_CO_WGGALLERY_IMAGE_MIMETYPE', 'Type MIME');
define ('_CO_WGGALLERY_IMAGE_SIZE', 'Taille');
define ('_CO_WGGALLERY_IMAGE_RES', 'R&eacute;solution');
define ('_CO_WGGALLERY_IMAGE_RESX', 'Resx');
define ('_CO_WGGALLERY_IMAGE_RESY', 'Resy');
define ('_CO_WGGALLERY_IMAGE_DOWNLOADS', 'T&eacute;l&eacute;chargements');
define ('_CO_WGGALLERY_IMAGE_RATINGLIKES', 'Notes J\'aime');
define ('_CO_WGGALLERY_IMAGE_VOTES', 'Votes');
define ('_CO_WGGALLERY_IMAGE_ALBID', 'Albums');
define ('_CO_WGGALLERY_IMAGE_STATE', '&Eacute;tat');
define ('_CO_WGGALLERY_IMAGE_IP', 'Ip');
define ('_CO_WGGALLERY_IMAGE_RESIZE', 'Redimensionner l\'image &agrave; la taille suivante:');
define ('_CO_WGGALLERY_IMAGE_THUMB', 'Vignette');
define ('_CO_WGGALLERY_IMAGE_MEDIUM', 'Image moyenne');
define ('_CO_WGGALLERY_IMAGE_LARGE', 'Grande image');
define ('_CO_WGGALLERY_IMAGE_ALL', 'Toutes les images');
define ('_CO_WGGALLERY_IMAGE_EXIF', 'Exif-data');
define ('_CO_WGGALLERY_IMAGE_ROTATE_LEFT', 'Rotation &agrave; gauche');
define ('_CO_WGGALLERY_IMAGE_ROTATE_RIGHT', 'Rotation &agrave; droite');
define ('_CO_WGGALLERY_IMAGE_ROTATED', 'Image pivot&eacute;e avec succ&egrave;s');
define ('_CO_WGGALLERY_IMAGE_ROTATE_ERROR', 'Erreur lors de la rotation de l\'image');
define ('_CO_WGGALLERY_IMAGE_ERRORUNLINK', 'Erreur lors de la suppression de l\'image: l\'image a &eacute;t&eacute; supprim&eacute;e dans la base de donn&eacute;es, mais une erreur s\'est produite lors de la suppression de l\'image elle-m&ecirc;me');
// Ajout / modification de filigrane
define ('_CO_WGGALLERY_WATERMARK_ADD', 'Ajouter un filigrane');
define ('_CO_WGGALLERY_WATERMARK_EDIT', 'Edit filigrane');
// &Eacute;l&eacute;ments de filigrane
define ('_CO_WGGALLERY_WATERMARK', 'Filigrane');
define ('_CO_WGGALLERY_WATERMARKS', 'Filigranes');
define ('_CO_WGGALLERY_WATERMARK_ID', 'Id');
define ('_CO_WGGALLERY_WATERMARK_PREVIEW', 'Aper&ccedil;u');
define ('_CO_WGGALLERY_WATERMARK_NAME', 'Nom');
define ('_CO_WGGALLERY_WATERMARK_TYPE', 'Type');
define ('_CO_WGGALLERY_WATERMARK_TYPETEXT', 'Utiliser le texte');
define ('_CO_WGGALLERY_WATERMARK_TYPEIMAGE', 'Utiliser une image');
define ('_CO_WGGALLERY_WATERMARK_POSITION', 'Position');
define ('_CO_WGGALLERY_WATERMARK_POSTOPLEFT', 'En haut &agrave; gauche');
define ('_CO_WGGALLERY_WATERMARK_POSTOPRIGHT', 'En haut &agrave; droite');
define ('_CO_WGGALLERY_WATERMARK_POSTOPCENTER', 'Haut au centre');
define ('_CO_WGGALLERY_WATERMARK_POSMIDDLELEFT', 'Milieu gauche');
define ('_CO_WGGALLERY_WATERMARK_POSMIDDLERIGHT', 'Milieu droit');
define ('_CO_WGGALLERY_WATERMARK_POSMIDDLECENTER', 'Centre central');
define ('_CO_WGGALLERY_WATERMARK_POSBOTTOMLEFT', 'En bas &agrave; gauche');
define ('_CO_WGGALLERY_WATERMARK_POSBOTTOMRIGHT', 'En bas &agrave; droite');
define ('_CO_WGGALLERY_WATERMARK_POSBOTTOMCENTER', 'En bas au centre');
define ('_CO_WGGALLERY_WATERMARK_USAGENONE', 'Actuellement non utilis&eacute;');
define ('_CO_WGGALLERY_WATERMARK_USAGEALL', 'Utiliser dans tous les albums');
define ('_CO_WGGALLERY_WATERMARK_USAGESINGLE', 'D&eacute;finis s&eacute;par&eacute;ment dans chaque album');
define ('_CO_WGGALLERY_WATERMARK_MARGIN', 'Marge');
define ('_CO_WGGALLERY_WATERMARK_MARGINLR', 'Gauche / droite');
define ('_CO_WGGALLERY_WATERMARK_MARGINTB', 'Haut / bas');
define ('_CO_WGGALLERY_WATERMARK_IMAGE', 'Image');
define ('_CO_WGGALLERY_FORM_UPLOAD_IMAGE_WATERMARKS', 'Image dans les images t&eacute;l&eacute;charg&eacute;es');
define ('_CO_WGGALLERY_WATERMARK_TEXT', 'Texte');
define ('_CO_WGGALLERY_WATERMARK_FONT', 'Police');
define ('_CO_WGGALLERY_WATERMARK_FONTFAMILY', 'Famille de Font');
define ('_CO_WGGALLERY_WATERMARK_FONTSIZE', 'Taille de la police');
define ('_CO_WGGALLERY_WATERMARK_COLOR', 'Couleur');
define ('_CO_WGGALLERY_WATERMARK_USAGE', 'Utilisation');
define ('_CO_WGGALLERY_WATERMARK_TARGET', 'Type d\'images pour l\'ajout de filigrane');
define ('_CO_WGGALLERY_WATERMARK_TARGET_A', 'Ajouter &agrave; tous');
define ('_CO_WGGALLERY_WATERMARK_TARGET_M', 'Ajouter au support');
define ('_CO_WGGALLERY_WATERMARK_TARGET_L', 'Ajouter &agrave; grand');
// &Eacute;l&eacute;ments de cat&eacute;gories
define ('_CO_WGGALLERY_CAT', 'Category');
define ('_CO_WGGALLERY_CATS', 'Cat&eacute;gories');
define ('_CO_WGGALLERY_CATS_SELECT', 'S&eacute;lectionner des cat&eacute;gories');
// &Eacute;l&eacute;ments de balises
define ('_CO_WGGALLERY_TAG', 'Balise');
define ('_CO_WGGALLERY_TAGS', 'Balises');
define ('_CO_WGGALLERY_TAGS_ENTER', 'Entrez des balises (veuillez utiliser #)');
// Autorisations
define ('_CO_WGGALLERY_PERMS_GLOBAL', 'Permissions global');
define ('_CO_WGGALLERY_PERMS_GLOBAL_USECOLL', 'Permissions globales pour utiliser les collections d\'albums');
define ('_CO_WGGALLERY_PERMS_GLOBAL_USECOLL_DESC', '<ul> <li> L\'utilisateur est autoris&eacute; &agrave; combiner plusieurs albums dans une collection d\'albums </li> </ul>');
define ('_CO_WGGALLERY_PERMS_GLOBAL_SUBMITALL', 'Permissions globales pour soumettre / &eacute;diter tous les albums');
define ('_CO_WGGALLERY_PERMS_GLOBAL_SUBMITALL_DESC', 'Groupes qui devraient avoir des autorisations pour <ul> <li> cr&eacute;er des albums </li> <li> modifier tous les albums </li> <li> approuver tous les albums </li> <li> t&eacute;l&eacute;charger des images &agrave; tous les albums </li> <li> approuver toutes les images </li> </ul> ');
define ('_CO_WGGALLERY_PERMS_GLOBAL_SUBMITOWN', 'Permissions globales pour soumettre / &eacute;diter vos propres albums sans approbation');
define ('_CO_WGGALLERY_PERMS_GLOBAL_SUBMITOWN_DESC', 'Groupes qui devraient avoir l\'autorisation de <ul> <li> cr&eacute;er des albums </li> <li> modifier vos propres albums </li> <li> t&eacute;l&eacute;charger des images dans vos propres albums </li> </ ul > ');
define ('_CO_WGGALLERY_PERMS_GLOBAL_SUBMITAPPR', 'Autorisations globales pour soumettre / &eacute;diter ses propres albums uniquement avec approbation');
define ('_CO_WGGALLERY_PERMS_GLOBAL_SUBMITAPPR_DESC', 'Groupes qui devraient avoir l\'autorisation de <ul> <li> cr&eacute;er des albums </li> <li> modifier vos propres albums </li> <li> t&eacute;l&eacute;charger des images dans vos propres albums </li> </ ul > ');
define ('_CO_WGGALLERY_PERMS_GLOBAL_DESC', '<ul>
                                                <li> '. _CO_WGGALLERY_PERMS_GLOBAL_USECOLL. ':'. _CO_WGGALLERY_PERMS_GLOBAL_USECOLL_DESC. '<br> </li>
                                                <li> '. _CO_WGGALLERY_PERMS_GLOBAL_SUBMITALL. ':'. _CO_WGGALLERY_PERMS_GLOBAL_SUBMITALL_DESC. '<br> </li>
                                                <li> '. _CO_WGGALLERY_PERMS_GLOBAL_SUBMITOWN. ':'. _CO_WGGALLERY_PERMS_GLOBAL_SUBMITOWN_DESC. '<br> </li>
                                                <li> '. _CO_WGGALLERY_PERMS_GLOBAL_SUBMITAPPR. ':'. _CO_WGGALLERY_PERMS_GLOBAL_SUBMITAPPR_DESC. '<br> </li>
                                           </ul> ');
define ('_CO_WGGALLERY_PERMS_ALB_VIEW', 'Autorisations de visualisation');
define ('_CO_WGGALLERY_PERMS_ALB_VIEW_DESC', 'Groupes qui devraient avoir les autorisations pour visualiser un album');
define ('_CO_WGGALLERY_PERMS_ALB_DLFULLALB', 'Autorisations pour t&eacute;l&eacute;charger l\'album complet');
define ('_CO_WGGALLERY_PERMS_ALB_DLFULLALB_DESC', 'Groupes qui devraient avoir les autorisations pour t&eacute;l&eacute;charger l\'album complet &agrave; la fois');
define ('_CO_WGGALLERY_PERMS_ALB_DLIMAGE_LARGE', 'Autorisations pour afficher / t&eacute;l&eacute;charger de grandes images');
define ('_CO_WGGALLERY_PERMS_ALB_DLIMAGE_LARGE_DESC', 'Groupes qui devraient avoir des autorisations pour afficher et t&eacute;l&eacute;charger de grandes images');
define ('_CO_WGGALLERY_PERMS_ALB_DLIMAGE_MEDIUM', 'Autorisations pour visualiser / t&eacute;l&eacute;charger des images moyennes');
define ('_CO_WGGALLERY_PERMS_ALB_DLIMAGE_MEDIUM_DESC', 'Groupes qui devraient avoir des autorisations pour visualiser et t&eacute;l&eacute;charger des images moyennes');
define ('_CO_WGGALLERY_PERMS_NOTSET', 'Aucun jeu d\'autorisations');
define ('_CO_WGGALLERY_PERMS_NODOWNLOAD', 'Vous n\'avez pas la permission de t&eacute;l&eacute;charger');
// exif
define ('_CO_WGGALLERY_EXIF', 'Fichier original des donn&eacute;es Exif');
define ('_CO_WGGALLERY_EXIF_ALL', 'Afficher tout');
define ('_CO_WGGALLERY_EXIF_FILENAME', 'Nom de fichier');
define ('_CO_WGGALLERY_EXIF_FILEDATETIME', 'Date du fichier');
define ('_CO_WGGALLERY_EXIF_FILESIZE', 'Taille du fichier');
define ('_CO_WGGALLERY_EXIF_MIMETYPE', 'Type MIME');
define ('_CO_WGGALLERY_EXIF_CAMERA', 'Marque de la cam&eacute;ra');
define ('_CO_WGGALLERY_EXIF_MODEL', 'Mod&egrave;le');
define ('_CO_WGGALLERY_EXIF_EXPTIME', 'Temps d\'exposition');
define ('_CO_WGGALLERY_EXIF_FOCALLENGTH', 'Focal Length');
define ('_CO_WGGALLERY_EXIF_DATETIMEORIG', 'Date heure d\'origine');
define ('_CO_WGGALLERY_EXIF_ISO', 'Vitesse ISO');
define ('_CO_WGGALLERY_EXIF_LENSMAKE', 'Marque de l\'objectif');
define ('_CO_WGGALLERY_EXIF_LENSMODEL', 'Mod&egrave;le d\'objectif');
// ---------------- Divers ----------------
define ('_CO_WGGALLERY_MAINTAINEDBY', 'Maintenu par');
define ('_CO_WGGALLERY_MAINTAINEDBY_DESC', 'Autoriser l\'url du site d\'assistance ou de la communaut&eacute;');

$moduleDirName = basename (dirname (dirname (__DIR__)));
$moduleDirNameUpper = mb_strtoupper ($moduleDirName);

// Exemples de donn&eacute;es
define ('CO_'. $moduleDirNameUpper. '_'. 'ADD_SAMPLEDATA', 'Importer des exemples de donn&eacute;es (supprimera TOUTES les donn&eacute;es actuelles)');
define ('CO_'. $moduleDirNameUpper. '_'. 'SAMPLEDATA_SUCCESS', 'Date simple upload&eacute; avec succ&egrave;s');
define ('CO_'. $moduleDirNameUpper. '_'. 'SAVE_SAMPLEDATA', 'Exporter les tables vers YAML');
define ('CO_'. $moduleDirNameUpper. '_'. 'SHOW_SAMPLE_BUTTON', 'Montrer un simple Bouton?');
define ('CO_'. $moduleDirNameUpper. '_'. 'SHOW_SAMPLE_BUTTON_DESC', 'Si oui, le bouton "Ajouter des exemples de donn&eacute;es" sera visible par l\'administrateur. Il est Oui par d&eacute;faut pour la premi&egrave;re installation.');
define ('CO_'. $moduleDirNameUpper. '_'. 'EXPORT_SCHEMA', 'Export DB Schema vers YAML');
define ('CO_'. $moduleDirNameUpper. '_'. 'EXPORT_SCHEMA_SUCCESS', 'Exporter le sch&eacute;ma DB vers YAML a &eacute;t&eacute; un succ&egrave;s');
define ('CO_'. $moduleDirNameUpper. '_'. 'EXPORT_SCHEMA_ERROR', 'ERREUR: &eacute;chec de l’exportation du sch&eacute;ma DB vers YAML');

//Menu
define ('CO_'. $moduleDirNameUpper. '_'. 'ADMENU_MIGRATE', 'Migration');
define ('CO_'. $moduleDirNameUpper. '_'. 'FOLDER_YES', 'Le dossier "%s" existe');
define ('CO_'. $moduleDirNameUpper. '_'. 'FOLDER_NO', 'Le dossier "%s" n\'existe pas. Cr&eacute;ez le dossier sp&eacute;cifi&eacute; avec CHMOD 777.');
define ('CO_'. $moduleDirNameUpper. '_'. 'SHOW_DEV_TOOLS', 'Montrer le bouton des outils de d&eacute;veloppement ?');
define ('CO_'. $moduleDirNameUpper. '_'. 'SHOW_DEV_TOOLS_DESC', 'Si oui, l\'onglet "Migrer" et les autres outils de d&eacute;veloppement seront visibles par l\'administrateur.');
define ('CO_'. $moduleDirNameUpper. '_'. 'ADMENU_FEEDBACK', 'Retour d\'information');

// V&eacute;rification de la derni&egrave;re version
define ('CO_'. $moduleDirNameUpper. '_'. 'NEW_VERSION', 'Nouvelle Version:');
define ('CO_'. $moduleDirNameUpper. '_'. 'ERROR_BAD_XOOPS', 'Vous avez besoin de la version minimale %s (votre version actuelle est %s)');



 //////////////////////////////////////////////////////////////////////////////////////

