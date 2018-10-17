
$(document).ready(function(){
	SendMessage();

	//BOTONES
	$('#abonar_cuentas').on('click',function(){
		var id=$('#id').val();
		var monto=$('#txt_monto').val();
		var comentario=$('#txt_comentario').val();
		var tipo=$('#tipo').val();
		$.ajax({
			type:'POST',
			cache:  false,
			url:'process.php?action=Cuentas&type=abonar',
			data:{'id':id,'monto':monto,'comentario':comentario,'tipo':tipo}
		})
		.done(function(result){
			if (result=="defaultValue") {
				SetMessage("index.php?view=Cuentas&type=activa","Se Registro Correctamente","SuccessMessage");
			}
			else
			{
				SetMessage("index.php?view=Cuentas&type=activa",result,"WarningMessage");
			}

		})
		.fail(function(result){
		})
	})

	$('#insert_Cuentas').on('click',function(){
		var nombre=$('#txt_nombre').val();
		var monto=$('#txt_monto').val();
		var comentario=$('#txt_comentario').val();
		var tipo=$('#tipo option:selected').val();

		$.ajax({
			type:'POST',
			cache:  false,
			url:'process.php?action=Cuentas&type=insert',
			data:{'nombre':nombre,'monto':monto,'comentario':comentario,'tipo':tipo}
		})
		.done(function(result){
			if (result=="defaultValue") {
				SetMessage("index.php?view=Cuentas&type=activa","Se Registro Correctamente","SuccessMessage");
			}
			else
			{
				SetMessage("index.php?view=Cuentas&type=activa",result,"WarningMessage");
			}

		})
		.fail(function(result){
		})
	})

	$('#actualizar_Cuentas').on('click',function(){
		var id=$('#id').val();
		var nombre=$('#txt_nombre').val();
		var monto=$('#txt_monto').val();
		var comentario=$('#txt_comentario').val();
		var tipo=$('#tipo option:selected').val();

		$.ajax({
			type:'POST',
			cache:  false,
			url:'process.php?action=Cuentas&type=update',
			data:{'nombre':nombre,'monto':monto,'comentario':comentario,'tipo':tipo,'id':id}
		})
		.done(function(result){
			if (result=="defaultValue") {
				SetMessage("index.php?view=Cuentas&type=activa","Se Registro Correctamente","SuccessMessage");
			}
			else
			{
				SetMessage("index.php?view=Cuentas&type=activa",result,"WarningMessage");
			}

		})
		.fail(function(result){

		})
	})

	localStorage['message']='nada';
	localStorage['type']='asd';

})
function Delete($pk)
{
		var pk=$pk;

		$.ajax({
			type:'POST',
			cache:  false,
			url:'process.php?action=Cuentas&type=delete',
			data:{'pk':pk}
		})
		.done(function(result){
			if (result=="defaultValue") {
				SetMessage("index.php?view=Cuentas&type=activa","Se Registro Correctamente","SuccessMessage");
			}
			else
			{
				SetMessage("index.php?view=Cuentas&type=activa",result,"WarningMessage");
			}


		})
		.fail(function(result){
		})
}

//SEND MESSAGE
function Message($message,$type)
{
	var message=$message;
	var type=$type;
	$.ajax({
			type:'POST',
			url:'message.php',
			data:{'message':message,'type':type}
		})
		.done(function(result){
			$('#mess').html(result);

		})
		.fail(function(){

		})	
}

function SetMessage($page,$message,$type)
{
		localStorage['message']=$message;
		localStorage['type']=$type;
		window.location.replace($page);

}
function SendMessage()
{
	var message=localStorage['message'] || 'defaultValue';
	var type=localStorage['type'] || 'defaultValue';

	if (type=='SuccessMessage') 
	{
		Message(message,type);
	}
	else if (type=='WarningMessage') 
	{
		Message(message,type);
	}


}
//END SEND MESSAGE
