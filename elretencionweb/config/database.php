<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database type. ie: mysql.  Currently supported:
				 mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Active Record class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|				 NOTE: For MySQL and MySQLi databases, this setting is only used
| 				 as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7
|				 (and in table creation queries made with DB Forge).
| 				 There is an incompatibility in PHP with mysql_real_escape_string() which
| 				 can make your site vulnerable to SQL injection if you are using a
| 				 multi-byte character set and are running versions lower than these.
| 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['autoinit'] Whether or not to automatically initialize the database.
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $active_record variables lets you determine whether or not to load
| the active record class
*/

$active_group = 'elretenciondb';
$active_record = TRUE;

/* db central de los demas sistemas.. usada para data comun */
$db['eladmindb']['hostname'] = '127.0.0.1';
$db['eladmindb']['username'] = 'root';
$db['eladmindb']['password'] = 'root';
$db['eladmindb']['database'] = 'eladmindb'; // usar el script que esta en directorio eladmindb
$db['eladmindb']['dbdriver'] = 'mysqli';
$db['eladmindb']['dbprefix'] = ''; /*blanks means use public , catalogo not use that due xtreme security */
$db['eladmindb']['pconnect'] = TRUE;
$db['eladmindb']['db_debug'] = FALSE;
$db['eladmindb']['cache_on'] = FALSE;
$db['eladmindb']['cachedir'] = '';
$db['eladmindb']['char_set'] = 'utf8';
$db['eladmindb']['dbcollat'] = 'utf8_general_ci';
$db['eladmindb']['swap_pre'] = '';
$db['eladmindb']['stricton'] = FALSE;

/* db central de la app la usa para determinar quien entra y sale y ve que cosa*/
$db['elretenciondb']['hostname'] = '127.0.0.1';
$db['elretenciondb']['username'] = 'root';
$db['elretenciondb']['password'] = 'root';
$db['elretenciondb']['database'] = 'elretenciondb'; // usar el script que esta en directorio elretenciondb
$db['elretenciondb']['dbdriver'] = 'mysqli';
$db['elretenciondb']['dbprefix'] = ''; /*blanks means use public , catalogo not use that due xtreme security */
$db['elretenciondb']['pconnect'] = TRUE;
$db['elretenciondb']['db_debug'] = FALSE;
$db['elretenciondb']['cache_on'] = FALSE;
$db['elretenciondb']['cachedir'] = '';
$db['elretenciondb']['char_set'] = 'utf8';
$db['elretenciondb']['dbcollat'] = 'utf8_general_ci';
$db['elretenciondb']['swap_pre'] = '';
$db['elretenciondb']['stricton'] = FALSE;

/* End of file database.php */
/* Location: ./application/config/database.php */
