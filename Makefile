TIMESTAMP := $(shell date +%Y-%m-%d-%H-%M)

all: build
	(git pull)

build:
	(composer install)

run:
	(php -S localhost:8000 api/public/index.php)

db_reset:
	composer dumpautoload
	php artisan migrate:refresh --seed

doc:
	(cd docs && make run)


deploy:
	#rsync -azvr --delete --exclude=api/storage/* --exclude=api/.env -e ssh api/ jinmacwattime@venus-poc-vm.us-west1-b.argon-key-292413:~/api/

	# deploy to /var/www/html/venus
	#rsync -azvr --delete --exclude=api/storage/* --exclude=api/.env -e ssh api/ wintest@venus-poc-vm.us-west1-b.argon-key-292413:/var/www/html/venus/

	# deploy with symlink
	rsync -azvr --exclude=.env -e "ssh -i ~/.ssh/id_rsa" api/ wintest@venus-poc-vm.us-west1-b.argon-key-292413:~/deploy/$(TIMESTAMP)/
	ssh -i ~/.ssh/id_rsa wintest@venus-poc-vm.us-west1-b.argon-key-292413 'cd deploy ; rm current ; ln -s $(TIMESTAMP) current ; cp ../env.bk ./current/.env; sudo chmod -R 777 current/storage;'

dry-run:
	#rsync -azvr -n --delete --exclude=api/storage/* --exclude=api/.env -e ssh api/ jinmacwattime@venus-poc-vm.us-west1-b.argon-key-292413:~/api/

	# deploy to /var/www/html/venus
	#echo $(TIMESTAMP);
	rsync -azvr --dry-run --delete --exclude=storage --exclude=.env -e "ssh -i ~/.ssh/id_rsa" api/ wintest@venus-poc-vm.us-west1-b.argon-key-292413:~/deploy/current/
