$(document).ready(function () {

	/* For the sticky navigation */
	$('.js--section-features').waypoint(function(direction){
		if(direction == "down"){
			$('nav').addClass('sticky');
		} else{
			$('nav').removeClass('sticky');
		}
	}, {
		offset: '60px;'
	});


	/* Scroll on buttons */ 
	$('.js--scroll-to-plan').click(function() {
		$('html, body').animate({scrollTop: $('.js--section-plans').offset().top}, 1000);
	});

	$('.js--scroll-to-start').click(function() {
		$('html, body').animate({scrollTop: $('.js--section-features').offset().top}, 1000);
	});



	/* Navigation scroll */

	$(function() {
		$('a[href*=#]:not([href=#])').click(function() {
			if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
				var target = $(this.hash);
				target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
				if (target.length) {
					$('html,body').animate({
						scrollTop: target.offset().top
					}, 1000);
					return false;
				}
			}
		});
	});

	/* Animations on scroll */
	$('.js--wp-1').waypoint(function (direction){
		$('.js--wp-1').addClass('animated fadeIn');
	}, {
		offset: '50%'
	});

	$('.js--wp-2').waypoint(function (direction){
		$('.js--wp-2').addClass('animated fadeInUp');
	}, {
		offset: '50%'
	});

	$('.js--wp-3').waypoint(function (direction){
		$('.js--wp-3').addClass('animated fadeIn');
	}, {
		offset: '50%'
	});

	$('.js--wp-4').waypoint(function (direction){
		$('.js--wp-4').addClass('animated pulse');
	}, {
		offset: '50%'
	});



	/* Mobile navigation */
	$('.js--nav-icon').click(function () {
		var nav = $('.js--main-nav');
		var icon = $('.js--nav-icon i');
		
		nav.slideToggle(200);
		
		if(icon.hasClass('ion-navicon-round')) {
			icon.addClass('ion-close-round');
			icon.removeClass('ion-navicon-round');
		} else{
			icon.addClass('ion-navicon-round');
			icon.removeClass('ion-close-round');
		}
		
	});

	/* confirm password */
	$('#pwd-confirm').on('blur', function(event){
		if( $('#password')[0].value != $('#pwd-confirm')[0].value){
			$('#pwdCheck_text').replaceWith('<div id="pwdCheck_text" style="color:red"><h4>비밀번호가 틀립니다<h4/></div>');
		}else{
			$('#pwdCheck_text').replaceWith('<div id="pwdCheck_text" style="color:green"><h4>비밀번호가 확인되었습니다<h4/></div>');
		}
	});

	/* check id */
	$('#id-checker').on('click', function(event){
		$('#id-checker').attr('clicked', 'clicked');
		$.post('process/checkEmail.php', {email: $('#email')[0].value})
			.done(function(data){
			alert(data);
		});
	});

	/* check required form */
	$('form').submit(function(event){
		var id_check = '';
		var client_type = false;
		var freelancer_type = false;
		var information = false;
		var terms = false;

		id_check = $('#id-checker').attr('clicked');
		client_type = $('#client-type').is(':checked');
		freelancer_type = $('#freelancer-type').is(':checked');
		information = $('#information').is(':checked');
		terms = $('#terms').is(':checked');

		if(id_check != 'clicked'){
			alert('아이디 중복체크를 해주세요');
			return false;
		};
		if(client_type == false && freelancer_type == false){
			alert('가입 유형을 선택해주세요');
			return false;
		};
		if(information == false || terms == false){
			alert('이용약관과 개인정보 취급방침에 동의해야 합니다');
			return false;
		};

		if( $('#password')[0].value != $('#pwd-confirm')[0].value){
			alert('비밀번호를 확인해주세요');
			return false;
		}

	})
});










