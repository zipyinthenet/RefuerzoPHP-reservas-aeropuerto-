<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

<p>Nombre: <input type="text" name="nombre" size="15" maxlength="20" value=""/></p>
<p>Destino:
<select name="destino">
<option value="valencia" >Valencia</option>
<option value="madrid" >Madrid</option>
<option value="barcelona" >Barcelona</option>
<option value="mallorca" >Mallorca</option>
<option value="sevilla" >Sevilla</option>
<option value="zaragoza" >Zaragoza</option>
<option value="granada" >Granada</option>
</select>
</p>
<p>Clase:
<input name="clase" type="radio" value="T" />Turista
<input name="clase" type="radio" value="B" />Bussiness
</p>
<p>Opciones (Puedes escoger más de una)<br/>
<input name="opciones[]" type="checkbox" value="R"/>
Reserva de asiento<br/>
<input name="opciones[]" type="checkbox" value="E"/>
Equipaje adicional<br/>
<input name="opciones[]" type="checkbox" value="S"/>
Seguro de viaje
</p>
<p>Número de pasajeros:<input name="num" type="text" value=""/></p>
<p><input type="submit" name="enviar" value="Reservar" /></p>

</form>


