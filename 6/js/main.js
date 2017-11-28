// $(document).ready(function() {
//
// 	$(".authors .items 	.but-remove").click(function(){
// 		$(this).parent().remove();
// 	});	//
//
// 	$(".sel-authors option").dblclick(function(){
// 		var id = $(this).val();
// 		var name = $(this).html();
// 		var	items = $(".authors .items input");
// 		for (var n=0; n<items.length; n++ ) {
// 			if ($( items[n] ).val() == id) return;
// 		}
//
// 		var str = $(".authors .item-tpl").html();
// 		str = str.replace('<!--', '');
// 		str = str.replace('-->', '');
// 		str = str.replace('#value#', id);
// 		str = str.replace('#name#', name);
// 		var last = $(".authors .items .item").last();
// 		if (last.length) {
// 			$(last).after(str);
// 		} else {
// 			$(".authors .items").html(str);
// 		}
//
// 		$(".authors .items .item").last().find(".but-remove").click(function(){
// 			$(this).parent().remove();
// 		});	//
//
// 	});	//
//
// 	$(".filter .open-close").click(function(){
// 		$(this).toggleClass("open");
// 		$(".filter form").toggleClass("open");
// 		if ($(this).hasClass("open")) {
// 			$(this).html("-");
// 		} else {
// 			$(this).html("+");
// 		}
// 	});
//
});