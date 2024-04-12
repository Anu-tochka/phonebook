$(document).ready(function() {
	let url = window.location.origin;  
	url = url + "/phonebook/"; // базовый url

	$("#form1").submit(function(e) {
		let record = {}; // собираем значения с формы
		let name = $('#name').val();
		record.name = name;
		let tel = $('#tel').val();
		record.tel = tel;
		
		$.ajax({
			url: url + "index.php",
			method: 'post',
			data: record,
			success: function(data){
				location.assign(url);
			}
		});
		
		e.preventDefault();
	});
	
// Удаление	
	$(".del").on("click", function(){
		let index = $(this).attr('id');
		$.ajax({
					url: url + "index.php/?del="+index,
					method: 'get',
					success: function(data){
						location.assign(url);
					}
		});
	});
});