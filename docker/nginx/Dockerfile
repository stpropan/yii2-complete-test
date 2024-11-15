FROM nginx
RUN apt-get update && apt-get install -y \
    bash \
    nano \
    less

COPY ./nginx.conf /etc/nginx/conf.d/default.conf
COPY ./root_nginx.conf /etc/nginx/nginx.conf