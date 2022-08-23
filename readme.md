# LAMP via Docker for Dummys

XAMP is good for an easy start
Docker is cool for everything else :)

# Important Information
- The hostname of the Databaseserver is "db_server"
- it is not possible to access the database via "localhost"
- Database is also reachable via Port "3306"
- to add PHP-Modulse, just use the Dockerfile
- This is just a demo and not for production usage.
- PHPMyAdmin is accessable via localhost:8080
- to start up, go to directory & use docker-compose up

# Requirements
- Install Docker
- On Windows: Install WSL (i.E. Ubuntu) via Microsoft Store

# TypeScript Requirement
- Install Homebrew: ``` /usr/bin/ruby -e "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/master/install)" ```
- Install Node: ``` brew install node ```
- Install Typescript ```sudo npm install -g typescript ```

# Database Credentials:
- MYSQL_ROOT_PASSWORD: my_secret_pw
- MYSQL_DATABASE: test_db
- MYSQL_USER: devuser
- MYSQL_PASSWORD: devpass