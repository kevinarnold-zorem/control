
$(document).ready(function(){
	SendMessage();

	 $("#pagomes_ABONAR").on("submit", function(e){
	e.preventDefault();
	var formData = new FormData(document.getElementById("pagomes_ABONAR"));

	$.ajax({
		url: "process.php?action=Abonar&type=abonarmes",
		type: "POST",
		dataType: "HTML",
		data: formData,
		cache: false,
		contentType: false,
		processData: false
	}).done(function(result){
			if (result=="defaultValue") {
				SetMessage("index.php?view=Mensualidad","Se Registro Correctamente","SuccessMessage");
			}
			else
			{
				SetMessage("index.php?view=Mensualidad",result,"WarningMessage");
			}
	});
});
	
	localStorage['message']='nada';
	localStorage['type']='asd';

})
function Delete($pk)
{
		var pk=$pk;

		$.ajax({
			type:'POST',
			cache:  false,
			url:'process.php?action=Mensualidad&type=delete',
			data:{'pk':pk}
		})
		.done(function(result){
			if (result=="defaultValue") {
				SetMessage("index.php?view=Mensualidad","Se Registro Correctamente","SuccessMessage");
			}
			else
			{
				SetMessage("index.php?view=Mensualidad",result,"WarningMessage");
			}


		})
		.fail(function(result){
		})
}

function reAbonar($id,$fecha)
{
		var fecha=$fecha;
		var id=$id;

		$.ajax({
			type:'POST',
			cache:  false,
			url:'index.php?view=Abonar',
			data:{'fecha':fecha,'id':id}
		})
		.done(function(result){
			
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
