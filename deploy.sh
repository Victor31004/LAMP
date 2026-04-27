echo 'Bajamos Repositorio Actualizado'
#Copiamos codigo actualizado de github
git pull origin main

echo 'Detenemos contenedores de la Aplicación'
#Detenemos contenedores
docker-compose down

echo 'Inicializamos contenedores y reconstruimos imagen actualizada'
#Inicializamos contenedores y reconstruimos
docker-compose -f docker-compose.production.yml up -d --build

echo 'Actualización Finalizada'