<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'itkaznmu_db' );

/** Имя пользователя MySQL */
define( 'DB_USER', 'adminkaznmu' );

/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', '123456' );

/** Имя сервера MySQL */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'DrLV})k?B^j]U5dSK)C]C)mApCn6go2)^X_cpV8>*I#,04rW}<C/spHBCRAnHh+&' );
define( 'SECURE_AUTH_KEY',  'kE?{h|2J[cqIkWpn?yxLT!3(9c8@LKx!02lWBD>vJaT+(Xc]fY$*9hl:[Lr>n0NL' );
define( 'LOGGED_IN_KEY',    ';voq(W!y_)kyZ18oJ$W#DgT=KD862<<beWD7mFmM54YWAwN8V/aB|2iaf%>5o<HM' );
define( 'NONCE_KEY',        'YiqQb= O?x -)@Z4*Ph@ed]dQ{K&TV~dbn$1h^wAKp;%|ZC8H5U27/&BfI<2_IPD' );
define( 'AUTH_SALT',        'FBqf^2+POS[K^Zg{ea~i)k]^~GgDrsFMDe_kiA2pJK fCkzsWct-3jO~0y<BN5-y' );
define( 'SECURE_AUTH_SALT', '8%GD)1*UKKlan<}-5+M3FQD$hyZ5qM)W}ssd8IR/ !h4*YrD.flp)i0i.h3,Vfj4' );
define( 'LOGGED_IN_SALT',   '?PEhP%5:,hg?<L1`zf~Y]rX#5/ioq^B`ts=x)+/N/N+csy.LqB/$xQ{KLWz7=oo|' );
define( 'NONCE_SALT',       'I@OqE9aR,k;Bbk8bWiw[k#oR]k`9u9AB*XbP,/9v>$]Mu(zOzljnj=PmUz/A 0N~' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once( ABSPATH . 'wp-settings.php' );
