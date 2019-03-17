#####################
#                   #
#   p h p           #
#                   #
#####################


yum  search php* ;     ## yum search instead of list

DONT USE WEBTATIC!

##############  2019-02-19 - installing php 7.3

yum --assumeyes install https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm ;
yum --assumeyes install http://rpms.remirepo.net/enterprise/remi-release-7.rpm ;

yum   --assumeyes  install yum-utils  ;

#####    yum-config-manager --enable remi-php71   [Install PHP 7.1]  ;
#####    yum-config-manager --enable remi-php72   [Install PHP 7.2]  ;

yum-config-manager --enable remi-php73   [Install PHP 7.3]  ;


yum  --assumeyes  install  \
php  \
php-cgi \
php-cli  \
php-common  \
php-curl \
php-fileinfo \
php-gd  \
php-ldap \
php-mbstring  \
php-mcrypt \
php-mysql  \
php-pdo  \
php-pdo_mysql \
php-pear  \
php-pecl-jsonc-devel  \
php-pecl-jsonc  \
php-pecl-propro  \
php-pecl-raphf  \
php-process  \
php-runtime  \
php-xml  \
php-xmlrpc \
php-zip \
;


======php setup =============

vi /etc/php.ini
date.timezone ='America/New_York'       ;    2016-02-19 from ‘initial setup’

; upload_max_filesize = 2M      ;    2016-02-19 from ‘initial setup’

upload_max_filesize = 64M      ;    2016-02-19 from ‘initial setup’

short_open_tag = On               ;    2016-02-19 from ‘initial setup’ allows  <?   ?>
memory_limit = 256M          ;       2016-02-19 from ‘initial setup’  changed from 128

include_path = "/usr/local/lib/php"



############ 2019-02-01  - converting php5.4 to php5.6:  
###################        (this seemed to cause issues with virtualmin)

yum  list installed | grep php ;    ## list everything associated with php


==  initial ==


php --version ;


== newer 5.6 version ==

yum  --assumeyes install https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm ;
yum   --assumeyes install http://rpms.remirepo.net/enterprise/remi-release-7.rpm  ;

yum   --assumeyes   install yum-utils;

yum-config-manager --enable remi-php56    [Intall PHP 5.6] ;        ## notice --enable


=== remove ====

yum-config-manager --disable remi-php56    [Intall PHP 5.6] ;

sudo yum   --assumeyes remove   php*  ;

###sudo yum   --assumeyes   remove php php-mcrypt php-cli php-gd php-curl php-mysql php-ldap php-zip php-fileinfo ; 


https://cloudlinux.zendesk.com/hc/en-us/articles/115004075294-Fix-rpmdb-Thread-died-in-Berkeley-DB-library

mkdir /var/lib/rpm/backup    ;
cp -a /var/lib/rpm/__db* /var/lib/rpm/backup/   ;
 rm -f /var/lib/rpm/__db.[0-9][0-9]*   ; 
rpm --quiet -qa   ;
rpm --rebuilddb   ;
yum clean all   ;

++++++++++++++++++++++++++++++++++++

It was suggested NOT to use webtatic:
https://www.mojowill.com/geek/howto-install-php-5-4-5-5-or-5-6-on-centos-6-and-centos-7/
rpm -Uvh https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm  ;
rpm -Uvh https://mirror.webtatic.com/yum/el7/webtatic-release.rpm   ;

Use ius instead:

https://ius.io/GettingStarted/
wget   https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm  ;
rpm -Uvh  epel*.rpm;
wget   https://centos7.iuscommunity.org/ius-release.rpm ;
rpm -Uvh   ius*.rpm ;
yum    list  |  grep  php56 ;

Notice the php##u (or w) - that letter designates the source of the repository
U = ius
W = webtatic



yum --assumeyes  erase php-*  ;   #remove any trace of earlier php
 Yum --assumeyes  remove  php70*;
###  note that php70 can easily be subsituted for php56
yum  --assumeyes  install                        \
                            php70w                  \
                            php70w-common     \
                            php70w-devel           \
                            php70w-gd                   \
                            php70w-imap               \
                            php70w-mbstring          \
                            php70w-mysql               \
                            php70w-odbc                 \
                            php70w-opcache      \
                            php70w-pear             \
                            php70w-pgsql                \
                            php70w-snmp                \
                            php70w-xml                 \
                            php70w-xmlrpc             ;


