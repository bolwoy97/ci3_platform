$(function(){
   'use strict'

	// Message
	$("#but1").on("click", function(e){
		var message = $("#message").val();
		if(message == ""){
			message  = "New Notification from Flaira";
		}
		swal(message);
	});

	// With message and title
	$("#but2").on("click", function(e){
		var message = $("#message").val();
		var title = $("#title").val();
		if(message == ""){
			message  = "New Notification from Flaira";
		}
		if(title == ""){
			title = "Notifiaction";
		}
		swal(title,message);
	});

	// Show image
	$("#but3").on("click", function(e){
		var message = $("#message").val();
		var title = $("#title").val();
		if(message == ""){
			message  = "New Notification from Flaira";
		}
		if(title == ""){
			title = "Notifiaction";
		}
		swal({
			title: title,
			text: message,
			imageUrl: '../assets/images/brand/favicon.png'
		});
	});

	// Timer
	$("#but4").on("click", function(e){
		var message = $("#message").val();
		var title = $("#title").val();
		if(message == ""){
			message  = "New Notification from Flaira";
		}
		if(title == ""){
			title = "Notifiaction Styles";
		}
		message += "(close after 2 seconds)";
		swal({
			title: title,
			text: message,
			timer: 2000,
			showConfirmButton: false
		});
	});
	
	//
	$("#click").on("click", function(e){
		var type = $("#type").val();
		swal({
			title: "Notifiaction Styles",
			text: "New Notification from Flaira",
			type: type
		});
	});
	
	// Prompt
	$("#prompt").on("click", function(e){

		swal({
			title: "Notification Alert",
			text: "your getting some notification from mail please check it",
			type: "input",
			showCancelButton: true,
			closeOnConfirm: false,
			inputPlaceholder: "Your message"
		},function(inputValue){


			if (inputValue != "") {
				swal("Input","You have entered : " + inputValue);

			}
		});
	});

	// Confirm
	$("#confirm").on("click", function(e){
		swal({
			title: "Notifiaction Styles",
			text: "New Notification from Flaira",
			type: "warning",
			showCancelButton: true,
			confirmButtonText: 'Exit',
			cancelButtonText: 'Stay on the page'
		});
	});

	
	$("#click").on("click", function(e){
		swal('Не хватает средств!', 'У вас не достаточно средств для такой покупки.', 'warning');
	});
	$("#click1").on("click", function(e){
		swal({
			title: "Внимание!",
			text: "Вы досрочно закрываете ордер. Эту операцию невозможно будет отменить! Сбор за закрытие - 20% от суммы покупки!",
			type: "warning",
			showCancelButton: true,
			confirmButtonText: 'Закрыть ордер',
			cancelButtonText: 'Не закрывать'
		});
	});
	$("#click2").on("click", function(e){
		swal({
			title: "Отличный выбор!",
			text: "Мы разместим ваш ордер как только вы подтвердите покупку",
			type: "success",
			showCancelButton: true,
			confirmButtonText: 'Подтверждаю покупку',
			cancelButtonText: 'Отменить'
		});
	});
	$("#click3").on("click", function(e){
		swal({
			title: "Notification Alert",
			text: "your getting some notification from mail please check it",
			type: "info",
			showCancelButton: true,
			confirmButtonText: 'Exit',
			cancelButtonText: 'Stay on the page'
		});
	});
});