Los puntos más resaltante del RIF DIGITAL es que se denomina ahora «REGISTRO ÚNICO DE INFORMACIÓN FISCAL» 
(artículo 4 providencia N° SNAT/2013/0048) y especifica que es «…único, exclusivo y excluyente…» y en el 
artículo 7 se establece la condición «activo o inactivo» (lo cual pienso yo es reflejo del uso de bases 
de datos por ordenadores) bajo ciertas condiciones (muerte de persona natural, por ejemplo).

## Modulo de RIF

El rif se trata aqui como directametne las razones sociales, cada rif es una razon social, 
por ende en el modulo el id de cada registro es el rif, su variable es `$cod_juridico`.

La data es guardada en una base de datos comun a varios proyectos en el que este es parte, 
el script de base de datos aqui solo crea la tabal si esta no existe, y debe estar en la base 
de datos aparte llamada `admindb`.

El modulo revisa que el usuario tenga el flag `ACTIVO` para las modificaciones, caso contrario 
solo permite listar la data de las razones sociales.

* `controllers/administrar/Razonsocial.php` Controlador para la administracion de RIFs sea 
  agente de retencion o agente a retener.
* `models/Admindbcrudmodel.php` Modelo de datos que procesa todo acerca de la base de datos 
  comun `admindb` este modulo solo procesa las razones sociales.
* `elretencionweb/views/admin_****.php` todas las vistas tiene el prefijo "admin" pero para 
  distincion se acompañan de "razonsocial" que distinge que hacen cada una.

## Codigo de calculo RIF

Volviendo al artículo 4 podemos observar la necesidad de identificar con correspondencia unívoca 
las personas naturales o jurídicas a un código alfanumérico.
A esto se le agrga un peso a cada digito del registro o cedula y por ultimo se calcula el 
numero de "checkeo" (así lo llamaba el SENIAT en 1998) que se resume entonces:

#### Primer caracter

El primer caracter del RIF debe ser alguno de los siguientes:
Cada uno de estos tien eun peso numerico: 

* V = 1: Venezolano o venezolana.
* E = 2: extranjero o extranjera (número de cédula mayor a 80 millones).
* P = 4: Pasaporte, por ejemplo es útil para los cantantes que se presentan en nuestro país y que hay que retenerles Impuesto sobre la renta.
* J = 3: Persona jurídica, osea, compañías anónimas, sociedades anónimas, S.R.L., etc.
* G = 5: Gobierno, entes gubernamentales, universidades, de cualquier Poder, estado, municipio e incluso organismos
* C = 6: Comunas, juntas comunal, cooperativas

El orden de esto y su peso numerico se estima que V,E y J estan correctos, 
el peso numerico de P,G y C se dedujo partiendo de el orden historico en que 
se crearon.

Este en la formula se le hara una multiplicacion:

* digito letra (su numero) se multiplica por 4

#### digitos de cedula o registro contribuyente

Se le sigue el numero de cedula o el registro del numero contribuyente, 
eto actualmente y estimado hasta 2030 estara limitado a 10 digitos, cada 
uno de estos digitos se va multiplicar por un numero especifico ya que 
estos son numeros.

* digito 1 se multiplica por 3
* digito 2 se multiplica por 2
* digito 3 se multiplica por 7
* digito 4 se multiplica por 6
* digito 5 se multiplica por 5
* digito 6 se multiplica por 4
* digito 7 se multiplica por 3
* digito 8 se multiplica por 2

#### Sumatoria de los caracteres sin el verificador

Tenemos la primera letra y los 8 digitos de la cedula/contribuyente, 
cada uno de estos se multiplica por un numero especifico.

* sumaria = suma de todos lso resultados de las multiplicaciones

#### Calculo del numero verificador

Despues de esas operaciones se suma cad uno de lso resultados individuales, 
y este se el aplica una  operacion que resulñtara en el ultimo 
numero que se le denomina numero verificador.

Lo siguiente es calcular el residuo resultante de dividir la Sumatoria 
entre 11, teniendo en cuenta que debemos saber el residuo del este cociente.

* numeropendinte = ABS( sumatoria / 11 )

Por último vamos a calcular la diferencia entre el residuo y la constante 11 
teniendo en cuenta que si el residuo es 0 u 1 el dígito de verificación valdrá cero

* residuo = sumatoria - (numeropendinte * 11)

Por ultimo el ultimo digito es calculado 

* DigiVal = 11 - Residuo;
* if (DigiVal > 9) DigiVal = 0;

#### Ejemplo de calculo

Hagamos un cálculo de ejemplo, para ello tomaremos a la Corporación Socialista 
del Cemento S.A  cuyo RIF es el siguiente: `G-20009048-0`, comenzemos por eliminar 
los guiones: `G200090480`.

1 - Descomponemos en digitos sin los giones:

* G toma el valor de 5 multiplicado por 4 =20
* 2 multplicado por 3 =   6
* 0 multplicado por 2 =   0
* 0 multplicado por 7 =   0
* 0 multplicado por 6 =   0
* 9 multplicado por 5 = 45
* 0 multplicado por 4 =  0
* * 4 multplicado por 3 = 12
* 8 multplicado por 2 = 16

2 - Sumamos los digitos

Sumamos:20+6+0+0+0+45+0+12+16=99

3 - Calculo de el numero verificador

Dividimos por 11 y tomamos el residuo que en este caso es cero: 99÷11=9

Dicho residuo lo restamos de once: 11-0=11 y como es mayor que 9 (tiene dos cifras) 
ENTONCES el dígito de verificación es cero lo cual corresponde con el RIF 
suministrado: `G-20009048-0`

