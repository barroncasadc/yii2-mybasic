CONTAINER_ID=$(docker ps | grep | 'php.dockerfile' | awk '{print $1}')

docker exec -it $CONTAINER_ID chown -R www-data:www-data /var/www/html
docker exec -it $CONTAINER_ID chmod -R 755 /var/www/html/web/assets

docker exec -it $CONTAINER_ID composer install

docker exec -it $CONTAINER_ID composer update

docker exec -it $CONTAINER_ID php yii migrate --interactive=0
