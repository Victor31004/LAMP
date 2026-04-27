#Copiamos codigo actualizado de github
git pull origin main

#Detenemos contenedores
docker-compose down

#Inicializamos contenedores y reconstruimos
docker-compose -f docker-compose.production.yml up -d --build