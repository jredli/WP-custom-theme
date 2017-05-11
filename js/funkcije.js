(function($) {	
    $(document).ready(function(){
		$('a').click(function(e){
			// Id posta iz linka
			var post_id = $(this).attr('id');
			
			$.ajax({
				type:'POST',
				url: templateUrl + '/ajax.php',
				data:{id:post_id},
				success:function(data){
					console.log(data);
					alert(data);
				}
			});
		});
	});
})( jQuery );