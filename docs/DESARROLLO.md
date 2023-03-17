# Como comenzar
===========================

Este documento le indicara instrucciones de como comenzar desarrollar y que usar en este proyecto

* [Como comenzar a trabajar](#como-comenzar-a-trabajar)
 * [1 Requisitos para trabajar](#1-requisitos-para-trabajar)
 * [2 Configurar tu entorno](#2-configurar-tu-entorno)
 * [3 clonar las fuentes](#3-clonar-las-fuentes)
 * [4 Cargar en Geany y ver en web](#4-cargar-en-geany-y-ver-en-web)
* [Estructura de desarrollo](#estructura-de-desarrollo)
 * [Codigo y fuentes](#codigo-y-fuentes)
 * [codigo PHP](#codigo-php)
 * [Como trabajar git](#como-trabajar-git)
* [Logica aplicacion web](#logica-aplicacion-web)
 * [Trabajar local webserver desde home](#trabajar-local-webserver-desde-home)


## Como comenzar a trabajar
---------------------------

Crear un directorio `Devel` en home, cambiarse a este y alli clonar el repo, iniciar y arrancar el editor Geany.

Todo esto se explica en detalle a continuacion por partes

### 1 Requisitos para trabajar

* git (manejador de repositorio y proyecto) `apt-get install git git-core giggle`
* geany (editor para manejo php asi como ver el preview) `apt-get install geany geany-plugin-webhelper`
* geany (editor para manejo php asi como web diseño) `apt-get install codelite codelite-plugins`
* lighttpd/apache2 (webserver localmente para trabajar el webview) `apt-get install lighttpd`
* php5 (interprete) en viejos 8- `apt-get install php5-cgi php5-xml phg5-xsl php5-gd php5-json php5-curl`
* php7 (interprete) en debian 9+ `apt-get install php-cgi php-xml php-xsl php-gd php-json php-curl`
* curl (invocar urls) `apt-get install curl`

Su usaurio de trabajo debera llamarse `general`, si aun no esta, crearlo ejecutando 
esto en una terminal como usuario `root` administrador:


```
/usr/sbin/adduser --gecos '' --disabled-password general

groupadd docker;groupadd dockers

/usr/sbin/usermod -a -G disk,dialout,voice,cdrom,floppy,tape,audio,video,games general > /dev/null 2>&1

/usr/sbin/usermod -a -G users,adm,netdev,lp,plugdev,docker,dockers,www-data general > /dev/null 2>&1

mkdir -m 775 -p /home/general/Devel && touch /home/general/Devel/.keep && chmod 554 /home/general/Devel/.keep

passwd general
```

**NOTA** el ultimo comando pregunta por la clave, mientras escribe no se vera nada.


### 2 Configurar tu entorno

configura el usuario git y coloca un enlace en la raiz del webserver a Devel 
para usar el proyecto:

```
git config --global status.submoduleSummary true
git config --global diff.submodule log
git config --global fetch.recurseSubmodules on-demand
git config --global http.postBuffer 524288000

```

Recuerde **cambiar `git config user.email name@mail` en el repo** y 
ahora como root ejecute:

```
ln -s /home/general/Devel /var/www/Devel
ln -s /home/general/Devel /var/www/html/Devel
chown -R general:www-data /home/general/Devel
find /home/general/Devel/ -type f -exec chmod 664 {} ";"
find /home/general/Devel/ -type d -exec chmod 775 {} ";"
```

Despues salga de la terminal como root y para verificar navegar 
a "http://127.0.0.1/Devel" y deberia cargar 
unos directorios y aparecer el del proyecto `elyanero` 


### 3 clonar las fuentes

Se usa git para tener las fuentes y se arranca el IDE geany para codificar, 
como usuario `general` clonar las fuentes en Devel de home:


``` 
mkdir -p ~/Devel
cd Devel
git clone --recursive https://gitlab.com/codeigniterpower/codeigniter-eltxt
cd elyanero
git pull
git submodule init
git submodule update --rebase
git submodule foreach git checkout master
git submodule foreach git pull
```


### 4 Cargar en Geany y ver en web

* abrir el geany
    * ir a menu->herramientas->admincomplementos
    * activar webhelper(ayudante web), treebrowser(visor de arbol) y addons(añadidos extras)
    * aceptar y probar el visor web (que se recarga solo) abajo en la ultima pestaña de las de abajo
    * cargar abajo en la ultima pestaña de webpreview la ruta http://127.0.0.1/Devel/ y visitar el proyecto
* en el menu proyectos abrir, cargar el archivo `Devel/elyanero/elyanero.geany` y cargara el proyecto
    * en la listado seleccionar el proyecto o el directorio `~/Devel/elyanero`
    * instalar `elyanero` sino esta aun instalado, esto es carga la db en 127.0.0.1 y se recarga solo

**NOTA IMPORTANTE** esto es asumiendo que su usuario se llama `general` y 
si no es asi debe modificar el proyecto para que cumpla con su ruta:

* con un editor de texto plano abrir el archivo elyanero.geany NO ABRIR CON EL GEANY!!
* borrar toda la seccion files si existiese y salvar el archivo

# Estructura de desarrollo
===========================

El sistema central tiene una interfaz web, por ahora construida con `PHP/codeigniter`, 
el usuario solo usa lo que aparece en esta ultima.

## Codigo y fuentes

El directorio [eltxtweb](eltxtweb) contiene el codigo fuente del sistema, 
se trabajara SQL y PHP con framework codeigniter2 y se maneja con GIT, 
abajo se describe cada uno y como comenzar de ultimo.

### Codigo PHP

Se emplea Codeigniter 2 y no 3 (aunque compatible), se describe mas abajo como iniciar el codigo, 
se describe como funciona aqui:

* **eltxtweb/controllers** cada archivo representa una llamada web y determina que se mostrara
* **eltxtweb/views** aqui se puede separar la presentacion de los datos desde el controller
* **eltxtweb/libraries** toma los datos y los amasa, moldea y manipula para usarse al momento o temporal
* **eltxtweb/models** toma los datos y los amasa, modea y prepara para ser presentados o guardados

### Modulos y Menu automatico

Los **Modulos** seran sub directorios dentro del directorio de controladores, 
cada sub directorio sera un modulo del sistema, y dentro cada clase controller 
sera una llamada web url, ademas de los que ya esten en el directorio `eltxtweb/controllers` 
que tambien seran una llamada web url.

El **Menu** sera automaticamente construido a partir de los subdirectorios y controladores, 
hay dos niveles de menu, el menu principal que es todo lo de primer nivel (directorios y los index) 
y el menu de cada modulo, que se construye pasando el nombre del subdirectorio (solo lso controlers).

En el directorio `eltxtweb/controllers`, para todo archivo que tenga en el nombre "index" 
sera incluido en el menu principal, adicional a todo subdirectorio, el resto de archivos, asi 
como los archivos despues de dicho primer nivel no seran incluidos para generar el menu principal.
Para el sub menu, segun el nombre el modulo (subdirectorio) de `eltxtweb/controllers`, 
se buscara todo archivo controller y sera incluido en la generacion de el submenu, y este se 
muestra debajo del menu principal.

## Como trabajar con git

El repositorio principal "eltxt" contine adentro el de codeingiter, de esta forma si se actualiza, 
si tiene contenido nuevo, hay que primero traerlo al principal, 
y despues actualizar la referencia de esta marca, entonces el repositorio principal tendra los cambios marcados.

**POR ENDE**: los commits dentro de un submodulo son independientes del git principal
1. primero antes de acometer cambios revise si hay desde elprincipal con fetch y pull
2. segundo haga commit y push en los submodulos antes de hacer commit y push en el principal
3. despues haga commit en el principal y push hacia el principal, todos estaran al dia

``` bash
git fetch
git pull
git submodule init && git submodule update --rebase
git submodule foreach git checkout master
git submodule foreach git pull
editor archivo.nuevo # (o abres el geany aqui y trabajas)
git add <archivo.nuevo> # agregas este archivo nuevo cambiado en geany al repo para acometer
git commit -a -m 'actualizado el repo adicionado <archivo.nuevo> modificaciones'
git push
```

En la sucesion de comandos se trajo todo trabajo realizado en los submodulos y actualiza "su marca" en el principal, 
despues que tiene todo a lo ultimo se editar un archivo nuevo y se acomete

**NOTA** Geany debe tener los plugins addons y filetree cargados y activados


# Logica aplicacion web
---------------------------

## Inicio sesion y modelo usuario

Este proyecto emplea un esquema de migracion hibrida, se emplea una db base mas no central, donde se hace 
pivote de usuario, acceso y acciones, despues se conecta a otras db remotas pór odbc para presentar datos.

En cada controlador solo se debe usar el "checku" y este se encargara de sacar o no de sesion 
a el usuario si no ha iniciado sesion, esto es todo, no hay que realizar mayores verificaciones.

### Core YA_Controler

Inicializa objetos de verificacion de sesion, modelo y libreria de usuario, y lo hace disponible.
Todos los controladores de lso modulos deben heredar de este, para poder facilmente ovidarse de 
verificaciones de sesion o de usuario.

* checku: revisa la sesion actual, empleando la libreria que a su vez emplea el modelo, si invalido, redirige login.
     * @access	public
     * @return	void

* render: pinta igual que el CI view, solo que este antepone el header y pone despeus el footer
     * @access	public
     * @param	array/string  Si string, el nombre de la vista a cargar, si array cada vista se carga en secuencia
     * @param	array     $data a pasar a las vistas tal comolo hace CI
     * @return	void

Ninguna de las funciones de este retorna valores, porque este controlador altera el flujo segun las credenciales.

**IMPORTANTE** la clase login debe hacer dos verificaciones una contra la intranet donde esta la clave, 
y otra contra la db local donde esta el usuario, si el usuario esta en intranet entra, pero si no esta en 
la db no puede ver nada, aunque entre. Esto es para facilitar el cambio de claves y separar permisos 
de manera descentralizada, mientras que la clave y acceso lo define intranet desde gerencia y nomina.

### Libreria Login

Se encarga de el transporte de informacion y datos entre la representacion de los datos y el manejo de acceso.
La libreia usa el modelo yan_usuario para verificar las credenciales,y toda operacion de acceso de datos.

* userlogin: validation user credentials, instancia el modelo yan_usuario y verifica las credenciales en db
     * @access	public
     * @param	string    usuaername o ficha
     * @param	string    userclave
     * @return	bool      TRUE o -1 si credenciales validas

* userlogout: destruye la sesion e invalida los datos en la db
     * @access	public
     * @param	string    usuaername o ficha
     * @return	void

* usercheck: check session user, if user are null check if there a currentl loged in user in true
     * @access	public
     * @param	string    usuaername o ficha, si no se provee detecta el actual
     * @return	integer   0/FALSE si el usuario no es ya valido

* userpass actualiza la clave en la tabla particular de esta base de datos. TAMBIEN LA ACTUALIZA OTRAS APPS
    * @access  public
    * @param  string Username
    * @param  string older passowrd
    * @param  string newer password
    * @return integer 0 si no se pudo o usuario invalido


### trabajar en home public_html

Trabaja desde su propio home, sin tener que alterar permisos o copiar manualmente a la raiz del htdocs:

```
su
apt-get install mariadb-server mariadb-client mysqlworkbench lighttpd php5-fpm php5-cgi php5-gd php5-mysql geany geany-addons
lighty-enable-mod accesslog cgi debian-doc dir-listing expire fastcgi proxy status userdir usertrack
lighty-disable-mod flv-streaming javagateway no-www proxyjabber rrdtool simple-vhost ssi ssl no-www
service lighttpd restart
exit
mkdir -p ~
ln ~/Devel/eltxt ~/public_html/eltxt
```

**NOTA** esto asume que tiene lighttpd usando public_html como directorio web en el home,en VenenuX es Html
