CONTAINER_ID=$( docker ps | grep php.dockerfile | awk '{print $1}' )

echo $CONTAINER_ID

docker exec -it $CONTAINER_ID chown -R www-data:www-data /var/www/html
docker exec -it $CONTAINER_ID chmod -R 755 /var/www/html/web/assets

docker exec -it $CONTAINER_ID composer install

docker exec -it $CONTAINER_ID composer update

docker exec -it $CONTAINER_ID php yii migrate --interactive=0

# In Windows Run this command
# winpty docker exec -it acc8d73489f7 bash && chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html/web/assets && composer install && composer update && php yii migrate --interactive=0