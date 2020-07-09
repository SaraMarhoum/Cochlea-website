<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en « wp-config.php » et remplir les
 * valeurs.
 *
 * Ce fichier contient les réglages de configuration suivants :
 *
 * Réglages MySQL
 * Préfixe de table
 * Clés secrètes
 * Langue utilisée
 * ABSPATH
 *
 * @link https://fr.wordpress.org/support/article/editing-wp-config-php/.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'cochlea' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'root' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', '' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', 'localhost' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/**
 * Type de collation de la base de données.
 * N’y touchez que si vous savez ce que vous faites.
 */
define( 'DB_COLLATE', '' );

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clés secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '0aDcH ooBOdxx+qz`^~i)LXqYPch)0a}&wRUx<k*kjy7Rrh-O>a&3K`<3ln(U@%]' );
define( 'SECURE_AUTH_KEY',  '_Om,/,{e|Am ~Y!VE||y0/h,{@:eP06`rTV#qP=1rOyQ3_&KGSjxM0b&fIQ{S&94' );
define( 'LOGGED_IN_KEY',    '&JO+[G-UYMVdl$wV HY+^c69#lVv__AAbBXS:wCLSHG{f+UXi9 #f_.vhoBlbnz&' );
define( 'NONCE_KEY',        'M5`(H=Up!g~pI9(K/LHj7>&r9R$8?8Tn)[-EE+TM%ONo~o+RP+e2+71oX{4HrP:%' );
define( 'AUTH_SALT',        'MlW.h{_0!FCpO/7Yb.cw;$1erU]x{=oys)yeu[arr)FqtJrLLM]h@v5.-sa#S*J8' );
define( 'SECURE_AUTH_SALT', 'RoGeCb#xn9f>=51.uQAfkbb U-H7JS7tyk}iulFqVHp5jmz5^3XjSukC1ky=K>lZ' );
define( 'LOGGED_IN_SALT',   '-:o.fi.i-r8;LxF>r=l! 9P33^J$RVP]7We4nh,$vmq-N&]n~T^.W4PTl?8<-+-S' );
define( 'NONCE_SALT',       'uW[?BrA837y Mh;Mq}xRorIJt 33. IY,^F4YjnPOMxHNqI,6@BntGNUj.MW[ =V' );
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://fr.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( ! defined( 'ABSPATH' ) )
  define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once( ABSPATH . 'wp-settings.php' );
