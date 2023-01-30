# Cyborg Proyecto DSW
<p id="readme-top"></p>

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![CodeFactor](https://www.codefactor.io/repository/github/sstark97/cyborg/badge)](https://www.codefactor.io/repository/github/sstark97/cyborg)

## Tabla de Contenidos

- <a href="#about">Sobre el Proyecto</a>
- <a href="#develop">Desarrollado con</a>
- <a href="#started">Getting started</a>
    - <a href="#requirements">Prerrequisitos</a>
    - <a href="#installation">Instalación</a>
- <a href="#views">Vistas</a>
- <a href="#docs">Documentación</a>
- <a href="#roadmap">Roadmap</a>
- <a href="#licence">Licencia</a>
- <a href="#contact">Contacto</a>

## Sobre el proyecto
<p id="about"></p>

![](https://i.imgur.com/w54IXnN.png)

Se trata de una tienda online de videojuegos similar a otros proyectos como Steam o Epic Store

Aquí encontrarás:
* Una lista con los videojuegos más populares del momento
* Podrás añadirlos a tu lista de deseados
* Tendrás acceso a un panel de administrador para gestionar los videojuegos

<p align="right">(<a href="#readme-top">Regresar arriba</a>)</p>

### Desarrollado con
<p id="develop"></p>

En esta sección se podrá ver las tecnologías para llevar a cabo el proyecto, tanto el front-end como el back-end.

* ![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)
* ![Bootstrap](https://img.shields.io/badge/bootstrap-%23563D7C.svg?style=for-the-badge&logo=bootstrap&logoColor=white)
* ![MariaDB](https://img.shields.io/badge/MariaDB-003545?style=for-the-badge&logo=mariadb&logoColor=white)

<p align="right">(<a href="#readme-top">Regresar arriba</a>)</p>

## Getting Started
<p id="started"></p>

A continuación veremos una serie de prerequisitos e indicaciones para llevar acabo este proyecto.

### Prerrequisitos
<p id="requirements"></p>

Para poder ejecutar este proyecto necesitamos tener instalado:

* PHP 7.4.10 o superior
* Composer 2.5.1
* MariaDB 10.4.14
* Apache 2.4.46
* Bootstrap 5

Si dispones de un sistema windows puedes descargarte el entorno AMP de [XAMPP](https://www.apachefriends.org/es/download.html)

### Instalación
<p id="installation"></p>

Para instalar el proyecto tenemos que:

1. Clonar el repositorio
   ```sh
   git clone https://github.com/your_username_/Project-Name.git
   ```
2. Instalar la Base de Datos, para ello debemos ejecutar el fichero PHP install, que se encuentra en el directorio config
   ```sh
   php ./config/install.php
   ```
3. Introduce tus variables de entorno `.env`
```shell=
DB_HOST=
DB_USER=
DB_PASS=
DB_NAME=
ADMIN_DNI=
ADMIN_NAME=
ADMIN_SURNAME=
ADMIN_EMAIL=
ADMIN_PHONE=
ADMIN_AGE=
ADMIN_PASS=

```
<p align="right">(<a href="#readme-top">Regresar arriba</a>)</p>

## Vistas
<p id="views"></p>

En esta sección podremos ver diferentes vistas del usuario.

### Login
En está vista el usuario podrá logearse y ver los posibles errores que puedan surgir en el proceso
![](https://i.imgur.com/eFDezV7.png)

### Register 
En está vista el usuario podrá registrarse y ver los posibles errores que puedan surgir en el proceso
![](https://i.imgur.com/wX64bPN.png)

### Home
En está vista el usuario podrá interactuar con la aplicación, ver los videojuegos más populares y añadirlos/eliminarlos de su lista de deseados.
![](https://i.imgur.com/r56Qb2g.png)

## Perfil
En está vista el usuario podrá ver los datos de su cuenta, además podra modificarlos, borrar su cuenta y ver toda la lista de sus videojuegos deseados.
![](https://i.imgur.com/iqjPLh9.png)

### Panel de Administrador
En esta vista el administrador ve una tabla con todos los videojuegos existente, pudiendo editar o borrar.
![](https://i.imgur.com/Fj5KbbU.png)

### Creación/Edición de Videojuegos
Esta vista es la misma para ambas acciones, en ella el administrador podrá crear y editar Videojuegos.
![](https://i.imgur.com/QkSVL1W.png)

### Eliminación de Videojuegos
En está vista el administrador podrá eliminar el videojuego cuyo id pasemos por GET.
![](https://i.imgur.com/pwr0oWj.png)

<p align="right">(<a href="#readme-top">Regresar arriba</a>)</p>

## Documentación
<p id="docs"></p>

Para acceder a la documentación técnica del proyecto [aqui](https://cyborg-dsw.herokuapp.com/docs/)

<p align="right">(<a href="#readme-top">Regresar arriba</a>)</p>

<!-- ROADMAP -->
## Roadmap
<p id="roadmap"></p>

- [x] CRUD Usuarios
- [x] CRUD Videojuegos
- [x] CRUD Lista de Deseados
- [x] Añadir comentarios a todo el código
- [x] Refactorizar controladores: funciones a Clases
- [x] Generar auto-load
- [x] Leer Variables de entorno
- [x] Subirlo a Producción

<p align="right">(<a href="#readme-top">Regresar arriba</a>)</p>

## Licencia
<p id="licence"></p>

Distribuido bajo la licencia MIT.

<p align="right">(<a href="#readme-top">Regresar arriba</a>)</p>

## Contacto
<p id="contact"></p>

Aitor Santana Cabrera - [@aitor_sci](https://mobile.twitter.com/aitorsci) - aitorscinfo@gmail.com

Link en Producción: [Cyborg](https://cyborg-dsw.herokuapp.com/index.php)

<p align="right">(<a href="#readme-top">Regresar arriba</a>)</p>
