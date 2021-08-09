.PHONY: lint, lint-summary, fix, lint-check

CS_SNIFF_CONFIG := phpcs.xml

lint:
	@echo "> Check coding style for diff sections only"
	@./vendor/bin/phpcs --standard=$(CS_SNIFF_CONFIG)

lint-summary:
	@./vendor/bin/phpcs --standard=$(CS_SNIFF_CONFIG) --report=summary

fix:
	@phpcbf --standard=$(CS_SNIFF_CONFIG)


lint-check:
	@./vendor/bin/phpcs  --standard=$(CS_SNIFF_CONFIG) -n
