# Objetivo

El objetivo de este ejercicio es validar las contraseñas del fichero **input.txt** según dos políticas de contraseñas.

Para la primera parte, cada línea del fichero representará la política y la contraseña que debe cumplirla. La política de
contraseñas indica el número mínimo y el número máximo de veces que se debe repetir la letra que hay a continuación. Así pues "1-3" significa que la contraseña debe de contener la letra "a" un mínimo de 1 y un máximo de 3 veces. Siguiendo esta norma, en el ejemplo vemos un total de 2 contraseñas válidas.
## Ejemplo de la política de contraseñas:

```
1-3 a: abcde
1-3 b: cdefg
2-9 c: ccccccccc
```

Para la segunda parte del ejercicio, tenemos una nueva forma de validar las contraseñas, donde,  la política describe lo siguiente: dos posiciones en la contraseña donde el número indica la posición del carácter (siendo 1 el primero, 2 el segundo… es decir, no hay índice 0). Entonces, exactamente 1 de las dos posiciones que aparecen deben de contener el carácter marcado, otras ocurrencias del carácter son irrelevantes.

## Ejemplo de la nueva política de contraseñas:
```
1-3 a: abcde es válida: la posición 1 contiene a y la
posición 3 no.

1-3 b: cdefg es no válida: Ni la posición 1 ni la 3
contienen el carácter b.

2-9 c: ccccccccc es no válida. Las dos posiciones 2 y 9
contienen el carácter c.
```

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