# Magenerds_Smtp

## Configuration
There are several ways to configure the SMTP module for your instance and your 
environment. You can use Magento's `setup:config:set` command and/or set the options
within the `setup:install` command. However, in each case Magento will persist the
configuration data in `app/etc/env.php`. You can edit this file manually and deploy
or mount it to your target environment.

### Command options 
for `setup:config:set` and `setup:install`

     --smtp-host       External SMTP host for mail transport
     --smtp-auth       Authentification method for SMTP transport
     --smtp-ssl        Use ssl or tls to secure SMTP transport
     --smtp-port       SMTP port
     --smtp-username   SMTP usename
     --smtp-password   SMTP password

Use `bin/magento setup:config:set --help` or `bin/magento setup:install --help`
for further information.

### (optional) env.php

    'smtp' => [
        'host' => 'mail.server.com',
        'auth' => 'login',
        'ssl' => '',
        'port' => '25',
        'username' => 'mail-user',
        'password' => 'P4ssW0rD',
    ],
