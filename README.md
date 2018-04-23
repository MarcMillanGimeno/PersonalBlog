# PersonalBlog
**Proyecto realizado por:**
	- Marc Millán Gimeno - ls29307

## Funcionamiento de la página web:
	
  # Usuario sin sesión iniciada ni registrado:
  El usuario que visite la página web, tendrá acceso a ver los 10 últimos post subidos en nuestro blog, pero en ningún caso tendrá acceso a publicar nada	ni tampoco a visualizar más entradas que las ultimas 10 subidas.

	Para registrarse deberá hacer click al boton **"Sign Up"**, de allí se redirigirá al usuario a otra pantalla donde podrá registrarse, en el caso de que insiera los datos correctamente, sinó se le mostrará el error se su registro para que pueda modificarlo.
	
  En el caso de que el registro sea correcto, se registrará al usuario con todos sus datos en la **Base de Datos**, y seguidamente se le redirigirá a la pagina principal para que posteriormente pueda iniciar sesión y disfrutar de los demás privilegios de la página web.

  # Sign in:
  Una vez el usuario escriba su nombre en el formulario de "user" y su contraseña "password" y le seleccione el botón "sign in" para iniciar sesión, pueden pasar dos cosas:
		
			1- Escriba el nombre del usuario y la contraseña incorrectamente y se le redireccione a otra pantalla donde se le mostrará el error.
			
			2- Lo escriba bien y pueda acceder a su sesion en la pagina web, pudiendo desde ahora ver todas las entradas publicadas que existan, y con el acceso a poder publicar el mismo sus propias entradas.
	
	# Usuario ya registrado:
  Cuando el usuario se haya logeado, en "sign in", se le mostran más seciones, en las cuales, como ya he explicado anteriormente, publicar sus propias entradas y poder ver todas las entradas publicadas.
  
  # Cierre de sesión
	El usuario, aunque cierre la pagina web, estará logeado durante 7 días, hasta que el decida cerrar su sesión
		clickando en el botón "Sign Out".
