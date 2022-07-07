# myfootball-project

> Consulta de partidos Europeos de Futbol mediante el consumo de una API de https://www.football-data.org/ mediante PHP Y Laravel.
> Se guarda la informacion de la consulta en la tabla matches de la base de datos football en mysql, verificando que no se repita la informaciòn consultada.
> El listado de la informacion consultada se la realiza en el proyecto consulta-partidos-futbol, mediante vue y axios
> https://github.com/marceinfomatic/consulta-partidos-futbol.git

## Versiones
Las versiones de las herramientas que el proyecto usa las puede ver en los archivos composer.json y package.json ubicados en la raiz del proyecto.

## Configuracion de la Base de Datos MySql
``` bash
Para ver la configuracion de la Base de Datos del proyecto puede revisar el archivo .env ubicado en la raiz del proyecto.
Para ejecutar la migracion:
Crear la base datos 'football' 
Ejecutar el comando php artisan migrate
```

## Build Setup

``` bash
Clonar el proyecto en su equipo local

# Installar dependencias
composer install

# Levantar el servidor en http://127.0.0.1:8000/
php artisan serve

```
