## Setup
1. Clone the repository from git

    sudo mkdir ~/www

    cd ~/www
    
    git clone url
    
1. Create storage/mysql/data folders in your home directory for mysql persistent storage and 
   give ownership to mysql user (UID 999)

    cd ~

    sudo mkdir -p storage/mysql/data

    cd storage/mysql

    sudo chown -R 999:999 data
    
1. Give write permissions to user on required folders

    cd ~/www/kellton-ikram

    sudo chmod -R 777 storage/app/public

    sudo chmod -R 777 storage/logs

    sudo chmod -R 777 storage/framework

    sudo chmod -R 777 bootstrap/cache

1. Start docker containers

    docker-compose up -d 

1. Install packages if not installed
   
    ./dock composer composer install

1. Update the database user name and password of database in .env file. Username and password will be available in environment section in under mysql in docker-compose.yaml file
    
    Example:

        DB = kellton

        DB_USERNAME=root
        
        DB_PASSWORD=password

1. For migrating Oauth tables to database using php container
    
        ./dock php php artisan migrate

1. Setup Application Encription key

        ./dock php php artisan key:generate

1. Seed database with inital data using custom db seed command.

        ./dock php php artisan db:seed

1. Admin Credentials
        email : admin@gmail.com
        password : admin