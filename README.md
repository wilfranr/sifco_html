# sifco_html
INFORME ADMINISTRATIVO

Alcance:
El presente informe administrativo abordará los temas necesarios para que el usuario realice con éxito la instalación del sistema de información.

INFORME TÉCNICO

Descripción de la arquitectura del sistema:

El programa está desarrollado usando los lenguajes de programación PHP y JAVASCRIPT junto a la librería JQUERY  y el administrador de base de datos MYSQL.

El sistema de información funcionará mediante los navegadores de internet EDGE, CHROME, FIREFOX y OPERA en sus últimas versiones.


Descripción del proceso de instalación y configuración del software:

Al ser un programa desarrollado como APLICACIÓN LOCAL PHP, será necesaria una instalación local, es decir, el programa podrá correr en cualquier dispositivo, siempre y cuando cumpla con,os requisitos mínimos, y desde cualquier sistema operativo; Siempre y cuando se tenga una copia en el disco duro los archivos necesarios para que el sistema funcione.



Requisitos de instalación

    • Se requiere de un gestor de base de datos MySQL y del servidor web Apache, se recomienda usar XAMPP.
    • Se sugiere la instalación de un sistema de control de versiones GIT  para realizar la clonación del repositorio (opcional)
    • En caso de no usar GIT se podrá realizar la descarga de los archivos necesarios para la instalación.
    • Para la ejecución del software es necesario estar conectado a internet, debido a que el programa usa librerías Online.



RECURSOS NECESARIOS

    • Repositorio en GitHub: https://github.com/wilfranr/sifco_html 
    • Base de datos: La base de datos se encuentra entre los archivos de instalación: 
/BD/sifcoweb.sql
    • XAMMP windows: https://www.apachefriends.org/xampp-files/8.1.6/xampp-windows-x64-8.1.6-0-VS16-installer.exe 
    • XAMMP Linux: https://www.apachefriends.org/xampp-files/8.1.6/xampp-linux-x64-8.1.6-0-installer.run 
    • XAMMP MAC: https://www.apachefriends.org/xampp-files/8.1.6/xampp-osx-8.1.6-0-vm.dmg 




PROCESO DE INSTALACIÓN

    • Descarga de archivos:

Opción 1: Se podrá realizar la clonación desde el repositorio de GitHub hacia la carpeta htdocs 
Windows C:\xampp\htdocs
Linux /opt/lampp/htdocs
MAC /opt/lampp/htdocs


			







	Opción 2: Desde el mismo repositorio se podrá realizar la descarga del archivo zip con 
	los archivos necesarios para la instalación del programa, estos archivos se deberán co	locar en la carpeta htdocs:
	Windows C:\xampp\htdocs
	Linux /opt/lampp/htdocs
	MAC /opt/lampp/htdocs



















	

	La base de datos se encuentra dentro de los archivos descargados en la ubicación:
	/Bd/sifcoweb.sql

    • Instalación:

Base de datos: Se debe crear una base de datos de nombre sifcoweb. Luego se importa desde phpmyadmin con el conjunto de caracteres UTF-8.
El usuario de la base de datos es root y no cuenta con contraseña.

Aplicativo: Con el repositorio ya clonado o los archivos descargados se debe ejecutar el servidor Apache y el servidor MySQL desde la interfaz de Xampp.


    • Acceso:
Para acceder a la aplicación se ingresa desde el navegador a la ruta: https://localhost/sifco_html/index.php

    • Usuarios:
SúperUsuario
Usuario: adsi1
Contraseña: adsi1

	Administrador
	Usuario: adsi2
	Contraseña: adsi2	

	Vendedor
	Usuario: adsi3
	Contraseña: adsi3

