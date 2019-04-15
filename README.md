#ADINO
# Laravel by Adino

### Installation

Install the dependencies and devDependencies and start the server.

```sh
$ git clone https://github.com/AdinoWayne/laravel_api.git
$ cd laravel_api
$ docker run --rm -v $(pwd):/app composer install
$ sudo chown -R $USER:$USER ~/laravel-app
$ cp .env.example .env
$ docker-compose up -d
$ docker-compose exec app vim .env
$ docker-compose exec app php artisan key:generate
$ docker-compose exec app php artisan config:cache
```
go to localhost
file .env
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=root
DB_USERNAME=adino
DB_PASSWORD=adino

Install docker when not found docker in this pc.

```sh
$ sudo apt-get install apt-transport-https ca-certificates
$ curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -
$ sudo add-apt-repository "deb [arch=amd64] https://download.docker.com/linux/ubuntu $ $ $(lsb_release -cs) stable"
$ sudo apt-get update
$ sudo apt-get install -y docker-ce
$ sudo systemctl enable docker
$ sudo usermod -aG docker ${USER}
$ sudo reboot
```
## 1.2 Install Docker-compose

  - Install using python-pip: 

```
sudo apt-get -y install python-pip
sudo pip install docker-compose
```

  - [OR] Install with download the latest version of Docker Compose:

```
sudo curl -L https://github.com/docker/compose/releases/download/1.21.2/docker-compose-$(uname -s)-$(uname -m) -o /usr/local/bin/docker-compose
sudo chmod +x /usr/local/bin/docker-compose
```
    
  - **Test the installation**: `docker-compose --version`

## 1.3 [OPTIONAL] Install docker-cleanup command

```
cd /tmp
git clone https://gist.github.com/76b450a0c986e576e98b.git
cd 76b450a0c986e576e98b
sudo mv docker-cleanup /usr/local/bin/docker-cleanup
sudo chmod +x /usr/local/bin/docker-cleanup




  

