
FROM httpd:2.4

RUN apt-get update && apt-get upgrade -y

#WORKDIR /app

# Enable mod_rewrite for images with apache
RUN if command -v a2enmod >/dev/null 2>&1; then \
    a2enmod rewrite headers \
;fi

#COPY ./httpd.conf /usr/local/apache2/conf/httpd.conf

# Copy apache vhost file to proxy php requests to php-fpm container
COPY maithai.apache.conf /usr/local/apache2/conf/maithai.apache.conf

RUN echo "Include /usr/local/apache2/conf/maithai.apache.conf" \
    >> /usr/local/apache2/conf/httpd.conf

RUN sed -i '/LoadModule rewrite_module/s/^#//g' /usr/local/apache2/conf/httpd.conf && \
    sed -i 's#AllowOverride [Nn]one#AllowOverride All#' /usr/local/apache2/conf/httpd.conf

EXPOSE 8080