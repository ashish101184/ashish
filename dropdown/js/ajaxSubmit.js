/*
 * Author : Ashish
 * Description  : This js will bind event in select box such like that when you will change any dropdown option then it will gives you unique
 * number and by that unique number you will get table number from the database.
 * Version : 1.0
 * 
 */
$(document).ready(function(){
	/*  Start
	 *  This will dropdown change then process. 
	 */
	$('select').bind('change',function() {
		initData();
	});
	/*  End  */
	
	/* Start 
	 * This will work for select row in table.
	 */
	$('#rowDiv div').children('select').bind('change',function() {
		initData();
	});
	/*  End  */
	
	
	/* Set Dynamic data-optioncount */
	setDropBoxIds();
	
	/* Call for deault set. */
	initData();
});
/*
 * This funciton will work like when you change option and accordingly it shows table data.
 */
function initData(){
	var tableValue = 1;
	var rowValue = $('#rowDiv div').children('select').val();	
	
	$("div select").each(function(){
		console.log($(this).attr("data-optioncount"));
		if(typeof ($(this).attr("data-optioncount")) != "undefined")
			tableValue = tableValue + parseInt(($(this).attr("data-optioncount") * $(this).val()));
	});
	
	$.ajax({
		type : 'POST',
		url : 'post.php',
		data: {
			tableId : tableValue,
			rowId : rowValue
		},
		success : function(data){
			$(".right_content").html(data);
		}
	});
}

/*
 * This will dynamically assign data-optioncount for logically work the process.
 */
function setDropBoxIds(){
	applydata = 1;
	$("#optionDiv>div select").each(function(){
		var id = $(this).attr("id");
		$(this).attr("data-optioncount",applydata);
		applydata = applydata * $("#"+id+" option").length;
		console.log(applydata);
		
	});
}