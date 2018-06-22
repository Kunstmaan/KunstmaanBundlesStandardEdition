FROM kunstmaan/spaceport-php:7.1
RUN composer create-project kunstmaan/bundles-standard-edition:dev-master . --no-interaction && chmod +x bin/console
COPY ./config_docker.yml /app/app/config/config_docker.yml
RUN composer update
RUN bin/console kuma:generate:bundle --namespace=Kunstmaan/DemoBundle --dir=src --env=docker
RUN bin/console kuma:generate:default-site --no-interaction --env=docker --demosite --prefix=demo_ --browsersync=http://myproject.dev --articleoverviewpageparent="HomePage,ContentPage"

COPY ./run.sh /scripts/run.sh
RUN chmod -R 755 /scripts
CMD ["/scripts/run.sh", "php-fpm7.1"]
WORKDIR /app
