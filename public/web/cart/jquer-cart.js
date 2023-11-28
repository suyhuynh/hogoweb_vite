function formatNumber (num) {
	if(num == 0){
		return '';
	}

	return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1"+config_product.price_format)+config_product.currency;
}
function getCookie(name) {
	var cookieValue = null;
	if (document.cookie && document.cookie !== '') {
		var cookies = document.cookie.split(';');
		for (var i = 0; i < cookies.length; i++) {
			var cookie = jQuery.trim(cookies[i]);
			if (cookie.substring(0, name.length + 1) === (name + '=')) {
				cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
				break;
			}
		}
	}
	return cookieValue;
}
function validate(evt) {
	var theEvent = evt || window.event;
	var key = theEvent.keyCode || theEvent.which;
	key = String.fromCharCode( key );
	var regex = /[0-9]/;
	if( !regex.test(key) ) {
		theEvent.returnValue = false;
		if(theEvent.preventDefault) theEvent.preventDefault();
	}
}
function sendMail(urlSendMail, urlRedirect){
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$.post( urlSendMail, {is_send: true})
	.done(function( data ) {
		
	})
	.fail(function() {
		
	});
	window.location.href = urlRedirect;
}
//==== logon ==========================================>
function RessetForm() {
	$("form input[type=text],form input[type=email], form input[type=number]").val("");
	$("form textarea").val("");
	$("form select").val("");
}
function SubmitForm(obj, class_obj) {
	var url = $(obj).attr("action");
	var Form = new FormData(obj);
	var dataTitle = $(obj).attr("data-title");
	$(obj).find('button[type=submit]').prop('disabled', true);
	$(obj).find('button[type=submit]').append('<i class="fa fa-spinner fa-pulse fa-fw"></i>');
	$.ajax({
		type: 'POST',
		url: url,
		data: Form,
		dataType: 'json',
		contentType: false,
		processData: false,
		crossDomain: true,
		// cache: true,
		// timeout: 3000,
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		error: function(){
			alertData(trans.msg.error_input, 'danger');
			$(obj).find($('button[type=submit] i')).remove();
			$(obj).find('button[type=submit]').prop('disabled', false);
		},
		success: function (data) {
			if (data.success == true) {
				alertData(data.msg, 'success');
				RessetForm();
				window.location.href = data.urlRedirect;
				$(obj).find($('button[type=submit] i')).remove();
				$(obj).find('button[type=submit]').prop('disabled', false);
			}
			else {
				if($.isPlainObject(data.msg) == true){
					for (var key in data.msg) {
						$(obj).find("[name=" + key + "]").parent().append("<span class='errors-class tooltip show-tooltip'>" + data.msg[key][0] + "</span>");
						$(obj).find("[name=" + key + "]").focus();
					}
				}
				else{
					alertData(data.msg, 'danger');
				}
				setTimeout(function () {
					$(".errors-class").remove();
				}, 3000);

				$(obj).find($('button[type=submit] i')).remove();
				$(obj).find('button[type=submit]').prop('disabled', false);
			}
		}
	});
}
//==== check out ==========================================>
function checkOutApp(array){
	$('#checkOutOrder').html('');
	var data = array.data;
	console.log(data);
	if(data.length <= 0){
		htmlData = '<div class="text-center order-empty">'+trans.msg.order_empty+'</div>';
	}else{
		var htmlData = '<table class="table">\
		<thead>\
		<tr>\
		<th width="65%">'+trans.product+'</th>\
		<th></th>\
		<th>'+trans.into_money_str+'</th>\
		</tr>\
		</thead>\
		<tbody>';
		for (var i = 0; i < data.length; i++) {
			htmlData += '<tr>\
			<td><span class="product-name">'+data[i].name+'</span>'+trans.sku+': '+data[i].options.sku+'</td>\
			<td>x'+data[i].qty+'</td>\
			<td>';
			if(data[i].price_sale > 0){
				htmlData += formatNumber(data[i].price_sale)+' - <strike>'+formatNumber(data[i].price)+'</strike>';
			}
			else{
				htmlData += formatNumber(data[i].price);
			}
		}
		htmlData += '</td>\
		</tr>';
		htmlData += '</tbody>\
		</table>\
		<div class="btn-groups ">';
		if(array.coupon.code == '')
		{
			htmlData += `<input type="text" class="form-control" id="coupon" onkeydown="return event.key != 'Enter';" placeholder="${trans.coupon}">
			<button type="button" class="button-pay btn btn-default" onclick="checkCoupon()">${trans.btn_access}</button>`;
		}else{
			htmlData += '<input type="text" class="form-control" readonly="" placeholder="'+array.coupon.code+'">\
			<button type="button" class="button-pay btn btn-default" onclick="deleteCoupon()">'+trans.delete+'</button>';
		}
		var total_sum = array.priceSum;
		htmlData += '</div><div class="transport-fee boder-pay">';
		htmlData += `
		<div class="discount fee">
		<span>${trans.provisional}:</span>
		<strong>${formatNumber(total_sum)}</strong>
		</div>
		`;
		if(array.fee == 0){
			htmlData += `<div class="fee-note text-center">${trans.msg.fee}</div>`;
		}else{
			total_sum = total_sum+array.fee;
			htmlData += `<div class="fee">
			<span>${trans.fee_delivery}: </span>
			<strong>${formatNumber(array.fee)}</strong>
			<input type="hidden" name="delivery_charges" value="${array.fee}">
			</div>
			`;
		}
		if(array.coupon.code != ''){
			htmlData += `
			<div class="discount fee">
			<span>${trans.sale_off} <span class="badge badge-warning" style="font-weight: 700;vertical-align: text-bottom;">${array.coupon.code}</span> :</span>
			<span class="price">${formatNumber(array.coupon.money)}</span>
			</div>
			`;
			total_sum = total_sum - array.coupon.money;
		}
		if(array.coupon.msg != ''){
			htmlData += `<div class="alert alert-danger text-center p-1 m-0">${array.coupon.msg}</div>`;
		}

		htmlData += `<div class="mt-2">
		<input type="hidden" name="total" value="${total_sum}">
		<h3>${trans.total_}: ${formatNumber(total_sum)}</h3>
		</div>`;
	}
	$('#checkOutOrder').html(htmlData);
}
//==== ==========================================>
function cartApp(array){
	$('#cart').html('');
	var data = array.data;
	var htmlCart = '<div class="cart-header">\
	<h4 class="header-title">'+trans.yes+' <span>'+array.total+'</span> '+trans.product_cart+'</h4>\
	<a href="javascript:closeCart();" class="btn-close">\
	<i class="fa fa-arrow-right"></i>\
	</a>\
	</div>\
	<div class="cart-body">\
	<div class="list-items" >';
	for (var i = 0; i < data.length; i++) {
		htmlCart += '<div class="item">\
		<a  href="javascript:deleteCart('+i+', '+data[i].id+');" class="btn-remove"></a>\
		<div class="item-image">\
		<img src="'+data[i].options.img+'" class="img-responsive">\
		</div>\
		<div class="item-info">\
		<h5 class="item-title">'+data[i].name+'<br><strong>'+trans.sku+'</strong>: '+data[i].options.sku+'</h5>\
		<strong class="item-price">';
		if(data[i].price_sale > 0){
			htmlCart += formatNumber(data[i].price_sale)+' - <strike>'+formatNumber(data[i].price)+'</strike>';
		}
		else{
			htmlCart += formatNumber(data[i].price);
		}
		htmlCart += '</strong>\
		<div class="input-group">\
		<a href="javascript:_descrease('+i+', '+data[i].id+');" class="input-group-addon">\
		<i class="fa fa-minus"></i>\
		</a>\
		<span class="form-control">'+data[i].qty+'</span>\
		<a href="javascript:_increase('+i+', '+data[i].id+');" class="input-group-addon">\
		<i class="fa fa-plus"></i>\
		</a>\
		</div>\
		</div>\
		</div>';
	}
	htmlCart += '</div>\
	</div>\
	<div class="cart-footer">\
	<div class="row">\
	<div class="col-12">\
	<div class="total">\
	<span class="total-title">'+trans.total+': </span>\
	<span class="total-price">'+formatNumber(array.priceSum)+'</span>\
	</div>\
	</div>\
	<div class="col-12">\
	<div class="btn-groups">\
	<a href="'+cartURL+'" class="btn btn-block btn-primary btn-go-to-cart"> <i class="fa fa-arrow-left"></i>'+trans.cart+'</a>\
	<a href="'+checkOutURL+'" class="btn btn-block btn-success btn-go-to-check-out">'+trans.payment+' <i class="fa fa-arrow-right"></i></a>\
	</div>\
	</div>\
	</div>\
	</div>';
	$('#cart').html(htmlCart);
}
function cartOrderApp(array){
	$('#cartOrder').html('');
	var data = array.data;
	var htmlOrder = '';
	if(data.length <= 0){
		htmlOrder = '<div class="text-center order-empty">'+trans.msg.order_empty+'</div>';
	}
	else{
		htmlOrder = '<table class="table table-bordered table-cart">';
		htmlOrder += '<thead>';
		htmlOrder += '<tr>';
		htmlOrder += '<th class="td-index">'+trans.stt+'</th>';
		htmlOrder += '<th class="td-image">'+trans.img+'</th>'; 
		htmlOrder += '<th class="td-name">'+trans.product_name+'</th>'; 
		htmlOrder += '<th class="td-price">'+trans.price+'</th>';
		htmlOrder += '<th class="td-quantity">'+trans.qty+'</th>'; 
		htmlOrder += '<th class="td-total">'+trans.into_money+'</th>';
		htmlOrder += '<th class="td-action"></th>';
		htmlOrder += '</tr>';
		htmlOrder += '</thead>';
		for (var i = 0; i < data.length; i++) {
			htmlOrder += '<tr><td data-show="false" class="td-index">'+ (i + 1)+'</td><td data-show="true"  class="td-image"><img src="'+data[i].options.img+'" class="img-responsive"></td><td data-show="true"  class="td-name">'+data[i].name+'<br><strong>'+trans.sku+'</strong>: '+data[i].options.sku+'</td><td data-show="true" data-title="'+trans.price+': " class="td-price">';
			if(data[i].price_sale > 0){
				htmlOrder += formatNumber(data[i].price_sale)+' - <strike>'+formatNumber(data[i].price)+'</strike>';
			}
			else{
				htmlOrder += formatNumber(data[i].price);
			}
			htmlOrder += '</td>'; 
			htmlOrder += '<td data-show="true" data-title="'+trans.qty+': " class="td-quantity">';
			htmlOrder += '<div class="right-cart">';
			htmlOrder += '<a href="javascript:_descrease('+i+', '+data[i].id+');"><i class="fa fa-minus"></i> &nbsp;</a>';
			htmlOrder += '<a>| &nbsp; '+data[i].qty+' &nbsp;|</a> &nbsp;';
			htmlOrder += '<a href="javascript:_increase('+i+', '+data[i].id+');"><i class="fa fa-plus"></i></a>';
			htmlOrder += '</div>';
			htmlOrder += '</td>';
			htmlOrder += '<td data-show="true" data-title="'+trans.into_money+': " class="td-total">';
			if(data[i].price_sale > 0){
				htmlOrder += formatNumber(data[i].price_sale * data[i].qty);
			}
			else{
				htmlOrder += formatNumber(data[i].price * data[i].qty);
			}
			htmlOrder += '</td>';
			htmlOrder += '<td data-show="true" data-title="" class="td-action">';
			htmlOrder += '<a href="javascript:deleteCart('+i+', '+data[i].id+');"><i class="fa fa-trash"></i></a>';
			htmlOrder += '</td>';
		}
		htmlOrder += '</tr><tr><td colspan="5" style="text-align: left;"><strong>'+trans.total+': </strong> </td>\
		<td colspan="2"><strong>'+formatNumber(array.priceSum)+'</strong></td></tr>';
		htmlOrder += '</tbody></table>';
		htmlOrder += '<div class="text-right">\
		<a href="/" class="button-white btn btn-default mg-right-15">'+trans.next_buy+'</a>\
		<a href="'+checkOutURL+'" class="btn btn-default">'+trans.proceed_payment+'</a>\
		</div>';
	}
	$('#cartOrder').html(htmlOrder);
}
function closeCart(){
	if($('body').hasClass('open-cart')){
		$('body').removeClass('open-cart');
		$('#cart').removeClass('active');
	}
	else{
		$('body').addClass('open-cart');
		$('#cart').addClass('active');
	}
}
function deleteCart(index, id){
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$.post( deleteCartURL, { _id: id, index: index })
	.done(function( data ) {
		if(data.success == true)
		{
			items.data.splice(index , 1);
			alertData(trans.msg.delete_cart_success, 'success');
			updateCart(items);
		}else{
			alertData(trans.msg.delete_cart_error, 'danger');
		}
	})
	.fail(function() {
		alertData(trans.msg.delete_cart_error, 'danger');
	});
}
function _increase(index, id){
	items.data[index].qty = items.data[index].qty + 1;
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$.post( quantityCartURL, { _id: id, index: index, quantity : items.data[index].qty }, function( data ) {

	});
	updateCart(items);
}
function _descrease(index, id){
	items.data[index].qty = items.data[index].qty - 1;
	if(items.data[index].qty <= 0){
		items.data[index].qty = 1;
	}
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$.post( quantityCartURL, { _id: id, index: index, quantity : items.data[index].qty }, function( data ) {
	});
	updateCart(items);
}
function checkData() {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$.post( '/checkCart', function( res ) {
		if(res.data.length){
			items.data = [];
			items.data.push(res.data);
			updateCart(items);
		}
		
	});
}
function updateCart(items) {
	var quantity = 0;
	var priceSum = 0;
	if(items.data){
		var data = [];
		$.each(items.data, function(index, val) {
			data.push(val);
			quantity = quantity + val.qty;
			if(val.price_sale > 0){
				priceSum = priceSum + (val.price_sale * val.qty);
			}
			else{
				priceSum = priceSum + (val.price * val.qty);
			}
		});
		items.data = data;
	}
	items.total = quantity;
	$('.tempCart').html(quantity);
	items.priceSum = priceSum;
	cartApp(items);
	cartOrderApp(items);
	checkOutApp(items);
}
$( document ).ready(function() {
	$('#cartSubmit').submit(function(event) {
		event.preventDefault();
		SubmitForm(this, '');
	});
	updateCart(items);
	var curr = $("#login");
	$(".check-signup input[type='radio']").on('change', function() {
		curr = $("input[type='radio']:checked").val();
		$('#'+curr).siblings().hide();
		$('#'+curr).fadeIn("slow");
	});
	$("#checkCod input[name=type]").on('change', function() {
		var checked = $("#checkCod input:checked").val();
		if(checked == 'atm'){
			$('#atm').fadeIn("slow");cartApp
		}
		else{
			$('#atm').fadeOut("slow");
		}
	});
	$('.add-to-cart').on('click', function(){
		var id = $(this).attr('data-id');
		var _this = this;
		$(_this).find('.fa').remove();
		$(_this).append('<i class="fa fa-spinner fa-pulse fa-fw"></i>');
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.post( addCartURL, { _id: id})
		.done(function( data ) {
			var isCheck = false;
			$('body').addClass('open-cart');
			$('#cart').addClass('active');
			if(data.success == true)
			{
				items.data = data.carts;

				$(_this).find('.fa').remove();
				$(_this).append('<i class="fa fa-cart-plus"></i>');
				alertData(trans.msg.add_cart_success, 'success');
				updateCart(items);
			}else{
				$(_this).find('.fa').remove();
				$(_this).append('');
				alertData(trans.msg.add_cart, 'danger');
			}
		})
		.fail(function() {
			alertData(trans.msg.add_cart, 'danger');
		});
	});
	$('.btn-buy-now').on('click', function(){
		var id = $(this).attr('data-id');
		var _this = this;
		$(_this).find('.fa').remove();
		$(_this).append('<i class="fa fa-spinner fa-pulse fa-fw"></i>');
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.post( addCartURL, { _id: id, buy_now: true})
		.done(function( data ) {
			var isCheck = false;
			if(data.success == true)
			{
				window.location.href = data.url;
			}else{
				$(_this).find('.fa').remove();
				$(_this).append('');
				alertData(trans.msg.add_cart, 'danger');
			}
		})
		.fail(function() {
			alertData(trans.msg.add_cart, 'danger');
		});
	});	
	$('body .product-page').on('click', function(){
		if($('body').hasClass('open-cart')){
			$('body').removeClass('open-cart');
			$('#cart').removeClass('active');
		}
	});
	$('.btn-show-cart, #btn-show-cart').on('click', function(){
		if($('body').hasClass('open-cart')){
			$('body').removeClass('open-cart');
			$('#cart').removeClass('active');
		}
		else{
			$('body').addClass('open-cart');
			$('#cart').addClass('active');
		}

	});
	$("#createAddpress").on('change', function() {
		RessetForm();
	});
	
	// phone
	$("input[name=phone").keypress(function(){
		validate(this.value);
	});

	if ($('.product-attributes .checkbox-size').length) {
		var id_click = 0;
		var id_click_first = product_attrs.length;
		var is_check = 0;
		$(".product-attributes .checkbox-size").click(function(event) {
			var checkbox = $(this).find('input[type=radio]');
			id_click = $(this).attr('data-key');
			// id_click_first = (id_click_first == 0) ? $(this).attr('data-key') : id_click_first;
			var is_show_btn_order = false;
			console.log(id_click+' -- '+id_click_first);
			if(id_click < id_click_first){
				$('.add-to-cart').prop('disabled', true);
				$('.btn-buy-now').prop('disabled', true);
				is_check = 1;
				$(".product-attributes .checkbox-size input[type=radio]").prop('disabled', true);
				$(this).parents('.attrFirst').find('input[type=radio]').removeAttr('disabled');
			}else{
				is_check = is_check + 1;
			}
			if(checkbox.is(':checked')){
				var value = checkbox.val();
				$.each(product_attrs, function(index, val) {
					if(jQuery.inArray(value, val.attributes) > -1){
						if(is_check >= val.attributes.length){
							is_show_btn_order = true;
							if(val.price_sale > 0){
								$('#price-preview span').text(formatNumber(val.price_sale));
								$('#price-preview del').text(formatNumber(val.price));
							}else{
								$('#price-preview span').text(formatNumber(val.price));
							}
						}
						$('.add-to-cart').attr('data-id', val.id);
						$.each(val.attributes, function(index, id) {
							$(".product-attributes .checkbox-size input[data-index="+id+"]").removeAttr('disabled');
						});
					}
				});
			}
			if(is_show_btn_order){
				$('.add-to-cart').removeAttr('disabled');
				$('.btn-buy-now').removeAttr('disabled');
			}
		});
	}
	callAPIProvince();
	coupon();
});
function callAPIProvince(){
	if(!$("select[name='province_id']").length){
		return;
	}
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$.get( '/api/provinces', function( res ) {
		if(res.data){
			$.each(res.data, function (i, item) {
				$("select[name='province_id']").append($('<option>', { 
					value: item.id,
					text : item.name 
				}));
			});
		}
	});
	$("select[name='province_id']").on('change', function() {
		var id = $(this).val();
		$('select[name=district_id]').empty();
		$('select[name=district_id]').append($('<option>', { 
			value: '',
			text : trans.select_ward
		}));
		$('select[name=ward_id]').empty();
		$('select[name=ward_id]').append($('<option>', { 
			value: '',
			text : trans.select_ward
		}));
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.get( '/api/province/'+id+'/districts', function( res ) {
			if(res.data){
				$.each(res.data, function (i, item) {
					$('select[name=district_id]').append($('<option>', { 
						value: item.id,
						text : item.name 
					}));
				});
			}

		});
		calFee({province_id: id});
	});

	$("select[name='district_id']").on('change', function() {
		var id = $(this).val();
		$('select[name=ward_id]').empty();
		$('select[name=ward_id]').append($('<option>', { 
			value: '',
			text : trans.select_ward
		}));
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.get('/api/district/'+id+'/wards', function( res ) {
			if(res.data){
				$.each(res.data, function (i, item) {
					$('select[name=ward_id]').append($('<option>', { 
						value: item.id,
						text : item.name 
					}));
				});
			}
		});
		calFee({district_id: id});
	});

	$("select[name='ward_id']").on('change', function() {
		var id = $(this).val();
		calFee({ward_id: id});
	});
}

function calFee(data) {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$.get('/cart/transport-fee', data, function( res ) {
		items.fee = res.fee;
		checkOutApp(items);

	});
}

function coupon(){
	$('.payment #checkOutOrder').on('change keydown paste', '#coupon', function(event) {
		if( event.key == 'Enter'){
			checkCoupon();
			event.preventDefault();
		}
	});
}
function checkCoupon(){
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$.post('/coupon/add', {coupon: $('.payment #checkOutOrder #coupon').val()}, function( res ) {
		items.coupon = res.coupon;
		checkOutApp(items);
	});
}
function deleteCoupon() {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$.post('/coupon/delete', {coupon: items.coupon.code}, function( res ) {
		items.coupon = {
			code: '',
			discount: 0,
			money: 0,
			msg: ''
		};
		checkOutApp(items);
	});
}