#!/bin/sh


TARGET=$VIRTUALSERVER_HOME/blank-files
INSTALL_FOLDER=$TARGET

cd $VIRTUALSERVER_HOME

# copy and modify composer.json
cp -rp $INSTALL_FOLDER/_composer.json ./composer.json
sed -i "s/ocular-nz\/blank/ocular-nz\/$VIRTUALSERVER_USER/g" composer.json

if [ "$VIRTUALSERVER_OWNER" = "" ] 
then
DESCRIPTION=$VIRTUALSERVER_USER
else
DESCRIPTION=$VIRTUALSERVER_OWNER
fi

sed -i "s/Base typo3 site/$DESCRIPTION/g" composer.json
  
# install composer dependencies
composer install

# install typo3
vendor/bin/typo3cms install:setup \
--force \
--database-user-name="$VIRTUALSERVER_MYSQL_USER" \
--database-user-password="$VIRTUALSERVER_MYSQL_PASS" \
--database-name="$VIRTUALSERVER_DB" \
--use-existing-database \
--admin-user-name="temporaryuser" \
--admin-password="temporarypassword" \
--site-name="$DESCRIPTION" \
--web-server-config="apache" \
--site-setup-type="no" \
--no-interaction 

# copy in files
cp -rp $INSTALL_FOLDER/fileadmin $VIRTUALSERVER_HOME/public/
cp -rp $INSTALL_FOLDER/version_controlled $VIRTUALSERVER_HOME/public/typo3conf/ext/
cp -p $INSTALL_FOLDER/_gitignore $VIRTUALSERVER_HOME/.gitignore
touch $VIRTUALSERVER_HOME/public/robots.txt

mkdir -p $VIRTUALSERVER_HOME/config/sites/$VIRTUALSERVER_USER
cp -p $INSTALL_FOLDER/siteconfig.yaml $VIRTUALSERVER_HOME/config/sites/$VIRTUALSERVER_USER/config.yaml

cat $INSTALL_FOLDER/htaccess_append >> $VIRTUALSERVER_HOME/public/.htaccess

# import database
mysql -u root -pwindy1 $VIRTUALSERVER_DB < $INSTALL_FOLDER/database.sql

# set up extensions
vendor/bin/typo3cms install:generatepackagestates
vendor/bin/typo3cms extension:setupactive

# tweak localconfiguration
vendor/bin/typo3cms configuration:remove SYS/systemMaintainers --force
vendor/bin/typo3cms configuration:set EXT/extConf/pb_social 'a:1:{s:11:"socialfeed.";a:11:{s:6:"devmod";s:1:"0";s:15:"ignoreVerifySSL";s:1:"0";s:9:"facebook.";a:1:{s:4:"api.";a:2:{s:2:"id";s:15:"851881428352076";s:6:"secret";s:32:"0d98909badecc1582703fdbee30987ad";}}s:8:"twitter.";a:2:{s:9:"consumer.";a:2:{s:3:"key";s:25:"OVd8qdjMHnRBzT6b0jeipvMNo";s:6:"secret";s:50:"3MEzBKBIzLIhvtXDlKkTu9SgsQZEmTwUQuo6CunMRvNFeKqtnd";}s:6:"oauth.";a:1:{s:7:"access.";a:2:{s:5:"token";s:50:"991084185593921537-dsxzjDJ30QKwrARY24r086JJk6B0jHH";s:12:"token_secret";s:45:"YlmZNfna7vGkrG3CPLk5QnCghAeaHHbNIAOhRCx0zby9q";}}}s:8:"youtube.";a:1:{s:6:"apikey";s:0:"";}s:6:"vimeo.";a:2:{s:7:"client.";a:2:{s:10:"identifier";s:0:"";s:6:"secret";s:0:"";}s:5:"token";s:0:"";}s:10:"pinterest.";a:1:{s:4:"app.";a:3:{s:2:"id";s:0:"";s:6:"secret";s:0:"";s:4:"code";s:0:"";}}s:10:"instagram.";a:1:{s:7:"client.";a:5:{s:2:"id";s:0:"";s:6:"secret";s:0:"";s:8:"callback";s:0:"";s:11:"access_code";s:0:"";s:12:"access_token";s:0:"";}}s:6:"imgur.";a:1:{s:7:"client.";a:2:{s:2:"id";s:0:"";s:6:"secret";s:0:"";}}s:7:"tumblr.";a:3:{s:9:"consumer.";a:2:{s:3:"key";s:0:"";s:6:"secret";s:0:"";}s:5:"token";s:0:"";s:12:"token_secret";s:0:"";}s:9:"linkedin.";a:2:{s:7:"client.";a:3:{s:3:"key";s:0:"";s:6:"secret";s:0:"";s:12:"callback_url";s:0:"";}s:12:"access_token";s:0:"";}}}'
vendor/bin/typo3cms configuration:set DB/Connections/Default/initCommands 'SET SESSION sql_mode = "NO_ENGINE_SUBSTITUTION";'
vendor/bin/typo3cms configuration:set SYS/enableDeprecationLog ''
# MAILGUN
vendor/bin/typo3cms configuration:set MAIL/transport 'smtp'
vendor/bin/typo3cms configuration:set MAIL/transport_smtp_encrypt 'tls'
vendor/bin/typo3cms configuration:set MAIL/transport_smtp_password 'aea296affea9358fa5bbb296cdedb9d2-4412457b-db61f811'
vendor/bin/typo3cms configuration:set MAIL/transport_smtp_server 'smtp.mailgun.org'
vendor/bin/typo3cms configuration:set MAIL/transport_smtp_username 'postmaster@mail.ocular.co.nz'

#clear cache
vendor/bin/typo3cms cache:flush

# chown files
chown -R $VIRTUALSERVER_USER:$VIRTUALSERVER_GROUP $VIRTUALSERVER_HOME/public
chown -R $VIRTUALSERVER_USER:$VIRTUALSERVER_GROUP $VIRTUALSERVER_HOME/var
chown -R $VIRTUALSERVER_USER:$VIRTUALSERVER_GROUP $VIRTUALSERVER_HOME/vendor

# create crontab for site
(crontab -u $VIRTUALSERVER_USER -l 2>/dev/null; echo "* * * * * $VIRTUALSERVER_HOME/vendor/bin/typo3cms scheduler:run") | crontab -u $VIRTUALSERVER_USER -

# add devs to permission group
 for OCULARUSER in ben benabbott luke; do
   usermod -aG $VIRTUALSERVER_USER $OCULARUSER
 done

# delete temporary files
rm -rf $INSTALL_FOLDER
