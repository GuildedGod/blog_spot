FROM mysql:latest

ENV MYSQL_DATABASE defyne
ENV MYSQL_DATABASE: cake
ENV MYSQL_USER: cake
ENV MYSQL_PASSWORD: cake

ADD defyne.sql /docker-entrypoint-initdb.d/

ENV MYSQL_ROOT_PASSWORD password
