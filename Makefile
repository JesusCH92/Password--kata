##    run:			run script use php cli
.PHONY : run
run:
	@docker run -it --rm --name my-running-script -v $(shell pwd):/usr/src/myapp -w /usr/src/myapp php:7.4-cli php oldJobPolicy.php


##    install:		install dependencies
.PHONY : install
install:
	docker run --rm --interactive --tty --volume $(shell pwd):/app composer install
	docker run -it --rm --name my-running-script -v $(shell pwd):/usr/src/myapp -w /usr/src/myapp php:7.4-cli vendor/bin/phpunit


##    run-test:			run test
.PHONY : run-test
run-test:
	@docker run -it --rm --name my-running-script -v $(shell pwd):/usr/src/myapp  -w /usr/src/myapp php:7.4-cli vendor/bin/phpunit --testdox