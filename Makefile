TIMESTAMP := $(shell date +%Y-%m-%d-%H-%M)

all: build
	(git pull)

build:
	(cd api && composer install && npm i && npm run dev)

run:
	(cd api && php artisan serve)

db_reset:
	composer dumpautoload
	php artisan migrate:refresh --seed


deploy:
	#rsync -azvr --delete --exclude=api/storage/* --exclude=api/.env -e ssh api/ jinmacwattime@venus-poc-vm.us-west1-b.argon-key-292413:~/api/

	# deploy to /var/www/html/venus
	#rsync -azvr --delete --exclude=api/storage/* --exclude=api/.env -e ssh api/ wintest@venus-poc-vm.us-west1-b.argon-key-292413:/var/www/html/venus/

	# deploy with symlink
	cd api && npm run prod
	ssh -i ~/.ssh/id_rsa wintest@venus-poc-vm.us-west1-b.argon-key-292413 \
		'cd deploy ; cp -rf latest bk-$(TIMESTAMP);'

	cd api && rsync -azvr --exclude ".env" --exclude="storage" -e "ssh -i ~/.ssh/id_rsa" \
		. wintest@venus-poc-vm.us-west1-b.argon-key-292413:~/deploy/latest/

	echo $(TIMESTAMP) >> deploy.log

dry-run:
	#rsync -azvr -n --delete --exclude=api/storage/* --exclude=api/.env -e ssh api/ jinmacwattime@venus-poc-vm.us-west1-b.argon-key-292413:~/api/

	# deploy to /var/www/html/venus
	#echo $(TIMESTAMP);
	rsync -azvr --dry-run --delete --exclude=storage --exclude=.env -e "ssh -i ~/.ssh/id_rsa" api/ wintest@venus-poc-vm.us-west1-b.argon-key-292413:~/deploy/current/
