# create databases
CREATE DATABASE IF NOT EXISTS `alijomehri_db`;
CREATE DATABASE IF NOT EXISTS `alijomehri_testing_db`;

# create root user and grant rights
GRANT ALL PRIVILEGES ON *.* TO 'root'@'localhost';
GRANT ALL PRIVILEGES ON *.* TO 'root'@'%';

FLUSH PRIVILEGES;