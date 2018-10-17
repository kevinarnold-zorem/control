
$(document).ready(function(){
	SendMessage();

	$('#profile_guardar').on('click',function(){
		var id=$('#id').val();
		var nombre=$('#txt_name').val();
		var correo=$('#email').val();
		var pasword=$('#pasword').val();

		$.ajax({
			type:'POST',
			cache:  false,
			url:'process.php?action=Usuarios&type=update2',
			data:{'nombre':nombre,'correo':correo,'pasword':pasword,'id':id}
		})
		.done(function(result){
			if (result=="defaultValue") {
				SetMessage("index.php?view=Home","Se Registro Correctamente","SuccessMessage");
			}
			else
			{
				SetMessage("index.php?view=Home",result,"WarningMessage");
			}

		})
		.fail(function(result){

		})
	})

	localStorage['message']='nada';
	localStorage['type']='asd';

})

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
