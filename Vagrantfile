# === bootstrap === #

$script = <<-SCRIPT
echo ...executing bootstrap script...
#temp - 
cd /vagrant && mv .env.example .env
#composer install
cd /vagrant && composer install
#pip install
cd /vagrant && pip install -r requirements.txt
#create app key
cd /vagrant && php artisan key:generate
#migrate database
cd /vagrant && php artisan migrate
#serve command
cd /vagrant && php artisan serve --host=0.0.0.0:8000 &
SCRIPT

# === config === #

Vagrant.configure("2") do |config|
  
  config.vm.box = "laravel/homestead"
  config.vm.provision "shell", inline: $script
  config.vm.network :forwarded_port, guest: 8000, host: 8080

end
