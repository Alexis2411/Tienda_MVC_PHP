# Use the official PHP image as a parent image
FROM php:7.4-apache

# Set the working directory
WORKDIR /var/www/html

# Copy the 'src' directory from the current directory into the container
COPY src /var/www/html

# Make the container listen on port 80
EXPOSE 80

# Start Apache
CMD ["apachectl", "-D", "FOREGROUND"]