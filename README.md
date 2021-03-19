# Requisitos del sistema

Para realizar este ejercicio se trabajó con PHP en un entorno dockerizado, así que es necesario tener instalado:
* Docker

# Ejecución del proyecto

## **Linux o Mac**
Si está trabajando con un S.O. de la familia de Unix (Linux o Mac), puede utilizar ejecutar lo siguiente:

**1. Instalar las dependencias**

Primero instale las dependencias con el siguiente comando:
```
make install
```

**2. Ejecutar el script**

Para visualizar el resultado de la primera parte del ejercicio, ejecute el comando:
```
make run
```

Para visualizar el resultado de la segunda parte del ejercicio, ejecute el comando:
```
make run-second-part
```

**3. Ejecutar los tests**

Para ejecutar los tests, ingrese el comando:
```
make run-test
```

## **Windows**

Si está trabajado con windows, siga los siguientes pasos:

**1. Instalar las dependencias**

Para instalar las dependencias, ejecute lo siguiente en este orden:
```
docker run --rm --interactive --tty --volume "$PWD":/app composer install
```
```
docker run -it --rm --name my-running-script -v "$PWD":/usr/src/myapp -w /usr/src/myapp php:7.4-cli vendor/bin/phpunit
```

**2. Ejecutar el script**

Para visualizar el resultado de la primera parte del ejercicio, ejecute el comando:
```
docker run -it --rm --name my-running-script -v "$PWD":/usr/src/myapp -w /usr/src/myapp php:7.4-cli php oldJobPolicy.php
```

Para visualizar el resultado de la segunda parte del ejercicio, ejecute el comando:
```
docker run -it --rm --name my-running-script -v "$PWD":/usr/src/myapp -w /usr/src/myapp php:7.4-cli php newJobPolicy.php
```

**3. Ejecutar los tests**

Para ejecutar los tests, ingrese el comando:
```
docker run -it --rm --name my-running-script -v "$PWD":/usr/src/myapp  -w /usr/src/myapp php:7.4-cli vendor/bin/phpunit --testdox
```