$(()=>{

	//trigger navbar narrow when user scrolls down
	let last_scroll_top = 0
	$(window).scroll(function(){
		let scroll_top = $(this).scrollTop()
		if(scroll_top > last_scroll_top){
			$(".navbar").addClass('shrink')
		} else if(scroll_top < last_scroll_top - 10) {
			$(".navbar").removeClass('shrink')
		}
		last_scroll_top = scroll_top
	})

})
