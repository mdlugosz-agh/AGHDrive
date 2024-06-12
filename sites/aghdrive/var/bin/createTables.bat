@ECHO OFF
REM $Id: App_DB_DataObject_createTables.bat,v 1.0 2019-12-04 20:43:31 arnaud Exp $
REM BATCH FILE TO EXECUTE PEAR::DB_DATAOBJECT createTables.php script

IF "%PHP_PEAR_PHP_BIN%"=="" SET "PHP_PEAR_PHP_BIN=C:\wamp\bin\php\php7.1.9\php.exe"

%PHP_PEAR_PHP_BIN% ./createTables.php "../../application/config/db/site.ini"


REM call ../pear/DB/scripts/DB_DataObject_createTables.bat "../../application/config/db/site.ini"