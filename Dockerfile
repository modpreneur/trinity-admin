FROM modpreneur/trinity-test


MAINTAINER Martin Kolek <kolek@modpreneur.com>

WORKDIR /var/app

EXPOSE 8080

ENTRYPOINT ["fish", "entrypoint.sh"]