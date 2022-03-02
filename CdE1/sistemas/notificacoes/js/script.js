$(document).ready(function(){
	lista();
	update();
});

function update(){
	$('#m-read').click(function(){
		var usuario = $("#m-read").val();
		$.ajax({
			type: 'POST',
			url: 'sys/mark-read.php?usuario='+usuario,
			dataType: "json",
			success: function(data){
				if(data.success== true){
					//
				}else{
					//
				}
			}, complete: function(){
				lista();
			},
		});
	});
}


function lista(){
	var usuario = $("#m-read").val();
	$.ajax({
		type: "post",
		url: "sys/get-notifi.php?usuario="+usuario,
		success: function(textStatus){
			$("#content-notifi").html(textStatus);
		}
	});
}