FROM mariadb:latest

LABEL name="mariadb-server"

ENV MARIADB_ROOT_PASSWORD=m1_s3cr3t

EXPOSE 3306

CMD [ "mysqld" ]