# CarServ Doc

# Comando para levantar proyecto con PHP 
php -S localhost:7000 -t public

# Levantar imagen de docker 
docker-compose up --build -d

# Detener contenedor de docker
docker-compose down

# Iniciar imagen
docker start web_server  

# Rollback a ultimo commit
git reset HEAD^ --hard
git push origin -f

# Traer la rama despues de cualquier conflicto
git reset --hard origin/name-branch

# Conexion con mysql alojada en la imagen de docker
docker exec -it mysql_db mysql -u root -p

# Comprobar el estado de servicios
sudo systemctl status mysql
service apache2 status

# Revisar los registros de mi imagen
docker logs web_server

netstat -tlnp | grep mysql
mysql -u root -p 

mysql -h 127.0.0.1 -P 3306 -u root -p'rootpassword'  TiendaVirtual
docker exec -it web_server bash