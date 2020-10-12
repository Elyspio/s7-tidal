# install on linux
sudo apt update
sudo apt install mysql-server php php7.4-mysql
sudo mysql_secure_installation


# database install (sudo mysql)
# CREATE database webapp
# CREATE USER 'xxx'@'xxx' IDENTIFIED WITH mysql_native_password BY 'xxx';
# GRANT ALL PRIVILEGES ON *.* TO 'xxx'@'xxx' WITH GRANT OPTION;
# Flush privileges;
