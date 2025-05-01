.PHONY: help lint dev install

help: ## Display this help
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

deploy: ## Déploie une nouvelle version
	php artisan app:export
	rsync -avH ./storage/app/private/movies.html -e ssh jonathan-boyer:~/sites/jonathan-boyer.fr/public/movies.html

lint: ## Format the code and generates new helpers
	./vendor/bin/pint
	php artisan ide-helper:generate --helpers
	php artisan ide-helper:meta
	php artisan ide-helper:models -M
	./vendor/bin/phpstan analyse --memory-limit=2G

dev: ## Start dev server
	parallel -j 2 --line-buffer ::: "php artisan serve" "bun run dev"

install: vendor/autoload.php .env public/build/manifest.json ## Install the project
	php artisan migrate
	php artisan app:user

.env:
	cp .env.example .env
	php artisan key:generate

public/build/manifest.json: package.json
	bun install
	bun run build

vendor/autoload.php: composer.lock
	composer install
	touch vendor/autoload.php
