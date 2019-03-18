# === bootstrap === #

$script = <<-SCRIPT
echo ...executing bootstrap script...
#composer install
#pip install
#migrate database
cd /vagrant/Queueify && php artisan migrate
#serve command
cd /vagrant/Queueify && php artisan serve --host=0.0.0.0:8000 &
SCRIPT

# === config === #

Vagrant.configure("2") do |config|
  
  config.vm.box = "laravel/homestead"
  config.vm.provision "shell", inline: $script
  config.vm.network :forwarded_port, guest: 8000, host: 8080

end
