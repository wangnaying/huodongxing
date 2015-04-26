function tips(obj,tip,status){
	obj.css('color','#fff');
	obj.val(tip);
	obj.blur(function(){
		if($(this).val() == ''){
			$(this).css('color','#fff');
			$(this).val(tip);
			if(status){
				$(this).attr('type','text');
			}
		}
	});
	obj.focus(function(){
		if($(this).val() == tip){
			$(this).css('color','#000');
			$(this).val('');
			if(status){
				$(this).attr('type','password');
			}
		}
	});
}