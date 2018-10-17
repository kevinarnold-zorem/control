
$(document).ready(function(){
	SendMessage();


	 $("#enviarimagenes").on("submit", function(e){
	e.preventDefault();
	var formData = new FormData(document.getElementById("enviarimagenes"));

	$.ajax({
		url: "process.php?action=Usuarios&type=insertimage",
		type: "POST",
		dataType: "HTML",
		data: formData,
		cache: false,
		contentType: false,
		processData: false
	}).done(function(result){
			if (result=="defaultValue") {
				SetMessage("index.php?view=Usuarios","Se Registro Correctamente","SuccessMessage");
			}
			else
			{
				SetMessage("index.php?view=Usuarios",result,"WarningMessage");
			}
	});
});

	//BOTONES
	$('#insert_usuario').on('click',function(){
		var nombre=$('#txt_name').val();
		var correo=$('#email').val();
		var pasword=$('#pasword').val();
		var anulado=document.getElementById('is_active').checked;
		var formData = new FormData(document.getElementById("enviarimagenes"));


		$.ajax({
			type:'POST',
			dataType: "HTML",
			url:'process.php?action=Usuarios&type=insert',
			data:{'nombre':nombre,'correo':correo,'pasword':pasword,'anulado':anulado}
			})
		.done(function(result){
			if (result=="defaultValue") {
				SetMessage("index.php?view=Usuarios","Se Registro Correctamente","SuccessMessage");
			}
			else
			{
				SetMessage("index.php?view=Usuarios",result,"WarningMessage");
			}

		})
		.fail(function(result){
		})
	})

	//registeer
	$('#register_usuario').on('click',function(){
		var nombre=$('#txt_name').val();
		var correo=$('#email').val();
		var pasword=$('#pasword').val();
		var anulado="true";

		$.ajax({
			type:'POST',
			cache:  false,
			url:'process.php?action=Usuarios&type=insert',
			data:{'nombre':nombre,'correo':correo,'pasword':pasword,'anulado':anulado}
		})
		.done(function(result){
			if (result=="defaultValue") {
				SetMessage("?view=signup","Se Registro Correctamente","SuccessMessage");
			}
			if (result=="Duplicate entry '"+correo+"' for key 'email'")
			{
				SetMessage("?view=signup","El correo ya esta Registrado","WarningMessage");
			}

		})
		.fail(function(result){
		})
	})

	$('#actualizar_usuario').on('click',function(){
		var id=$('#id').val();
		var nombre=$('#txt_name').val();
		var correo=$('#email').val();
		var pasword=$('#pasword').val();
		var anulado=document.getElementById('is_active').checked;

		$.ajax({
			type:'POST',
			cache:  false,
			url:'process.php?action=Usuarios&type=update',
			data:{'nombre':nombre,'correo':correo,'pasword':pasword,'anulado':anulado,'id':id}
		})
		.done(function(result){
			if (result=="defaultValue") {
				SetMessage("index.php?view=Usuarios","Se Registro Correctamente","SuccessMessage");
			}
			else
			{
				SetMessage("index.php?view=Usuarios",result,"WarningMessage");
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
			url:'process.php?action=Usuarios&type=delete',
			data:{'pk':pk}
		})
		.done(function(result){
			if (result=="defaultValue") {
				SetMessage("index.php?view=Usuarios","Se Registro Correctamente","SuccessMessage");
			}
			else
			{
				SetMessage("index.php?view=Usuarios",result,"WarningMessage");
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
