$(document).ready(function(){
	
	$('.tr-check, .btn-warning, .btn-danger').hide(); // скрывает checkbox и кнопки (удалить, редактировать)
		/* возвращает checkbox */
	$('.btn-info').on("click", function(){
		var check_count = $('.table').find(':hidden').size();
		
		if(check_count == 2){
			$('.tr-check').hide(150);
			return false;
		}
		else{
			$('.tr-check').show(150);
		}
	});
	
		/* показывает/скрывает кнопки (удалить, редактировать) */
	$('.tr-check').on("change", function(){
		$('.btn-warning, .btn-danger').show(200);
		var checked_count = $(':checked').size(); //кол-во отмеченных полей
		if(checked_count == 0){
			//скрывает кнопки если не отмечены поля
			$('.btn-warning, .btn-danger').hide(150);
		}
	});
	
		/* удаление полей */
	$('.btn-danger').on("click", function(){
		var checked_count = $(':checked').size(); //кол-во отмеченных полей
		var checked_id = Array(); //массив отмеченных id
		for(var i=0;i<checked_count;i++){
			checked_id[i] = $(':checked').eq(i).val();
		}
		checked_id = JSON.stringify(checked_id);
		$.ajax({
			type: "POST",
			url: "ajax/ajax_query.php",
			data: "del_row=1&checked_id="+checked_id,
			success: function(msg){
					$(':checked').parent().parent().remove();
					$('.btn-warning, .btn-danger').hide(150);
				$('table').after("<p class='msg'>Записи удалены с БД. Количество: "+checked_count+"</p>");
				$('.msg').delay(2000).fadeOut(1000);
			}
		});
	});	
	
		/* редактировать записи */
	$(".btn-warning").on("click", function(){
		var checked_size = $(':checked').size();
			/* клик по ссылке выбранных записей таблицы */
		for(var i=0;i<checked_size;i++){
			var this_tr = $(':checked').eq(i).parent().parent();
			this_tr.find('a').click();
		}
	});
	
		/* Выбор всех элементов checkbox */
	$('th a').on("click", function(event){
		event.preventDefault();
		$(':checkbox').click();
	});
	
		/* при клике по ссылке преобразует значения в таблице в input для редактирования */
	$('tr td a').on("click", function(event){
		event.preventDefault();
		var this_tr = $(this).parent().parent();
		var td_size = this_tr.find("td").size();
		for(i=2;i<td_size;i++){
			var this_value = this_tr.find("td").eq(i).text();
			var this_class = this_tr.find("td").eq(i).attr('name');
			this_tr.find('td').eq(i).html('<input type="text" value="'+this_value+'" class="td-text-input inp-'+this_class+'" />');
		}
			/* удаление ссылки */
		var this_id = $(this).text();
		$(this).after('<p class="this_id">'+this_id+'</p>').remove();
			/* скрывает кнопки, и колонку checkbox */ 
		$('.tr-check, .td-buttons > *').hide();
		$('.td-buttons').prepend('<input type="button" class="btn" name="btn-save" value="Сохранить" />');
	});
	
		/* сохраняет редактированные записи */
	$(document).on("click", 'input[name="btn-save"]', function(){
		var row_size = $('.this_id').size();	//кол-во измененных записей
			//составляет массив данных из input
		var return_array = new Array();
		for(var i=0;i<row_size;i++){
			var this_tr = $('.this_id').eq(i).parent().parent();
			return_array[i] = new Object(); 
			return_array[i]['this_id'] = this_tr.find(".this_id").text();
			return_array[i]['name'] = this_tr.find(".inp-name").val();
			return_array[i]['surname'] = this_tr.find(".inp-surname").val();
			return_array[i]['sexual-identity'] = this_tr.find(".inp-sexual-identity").val();
			return_array[i]['age'] = this_tr.find(".inp-age").val();
			return_array[i]['group'] = this_tr.find(".inp-group").val();
			return_array[i]['faculty'] = this_tr.find(".inp-faculty").val();
		}
		return_array = JSON.stringify(return_array);
		$.ajax({
			type: "POST",
			url: "ajax/ajax_query.php",
			data: "update_row="+return_array,
			success: function(msg){
				window.location.href = "index.php";//после сохранения изменений редирект на главную страницу
			}
		});
		
	});	
	
		/* добавление записи в таблицу */
	$(document).on("click", "#add_into", function(){
		var text_inputs_count = $('input.form-control').size();
		var record_array = new Object();
		for(var i=0;i<text_inputs_count;i++){
			var this_index = $('input.form-control').eq(i).attr('name');
			var this_value = $('input.form-control').eq(i).val();
			record_array[this_index] = this_value;
		}
		record_array = JSON.stringify(record_array);
		$.ajax({
			type: "POST",
			url: "ajax/ajax_query.php",
			data: "add_into=1&record_array="+record_array,
			success: function(msg){
				$('input[type="text"]').val("");
				$('.form-in').after('<p class="msg">Запись добавлена в БД</p>');
				$('.msg').delay(2000).fadeOut(1000);	
			}
		});		
	});
	
		/* удаляет таблицу, загружает форму (add_new.html) для добавления студента */
	$('.nav-tabs li a').eq(1).on("click", function(event){
		event.preventDefault();
		$('div.container > *').remove();
		$.ajax({
			url: "tmpl/add_new.html",
			cache: false,
			success: function(html){
				$('div.container').prepend(html);
			}
		});
	});
	
});//end ready 