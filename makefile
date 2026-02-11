install:
	bin/composer install

start:
	php -S localhost:8080

test:
	./vendor/bin/phpunit tst

lint:
	@echo "--- 1. PHP Lint (Syntaxe) ---"
	-find . -type f -name "*.php" -not -path "./vendor/*" -not -path "./data/*" -exec php -l {} \;
	@echo "--- 2. PHP Code Sniffer (Standards PSR) ---"
	-php ./vendor/bin/phpcs --extensions=php ./lib/
	@echo "--- 3. PHP Mess Detector (Complexité) ---"
	-php ./vendor/bin/phpmd ./lib ansi codesize,unusedcode,naming