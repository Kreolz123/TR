$(document).ready(function() {
	
	$("#butSubmit").click(function( event ){
		event.preventDefault();
		
		var data = {
			search: $("#search").val(),
			ajax: true,
			};
		
		$.ajax({
			url: '',
			method: "POST",
			data: data,
			success: function(result) {
					$(".content").html( result );
				},
			error: function(result){
					alert('Ошибка');
				}
		});
	});
	
});