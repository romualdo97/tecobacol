$(document).ready(function(e){
	var floatWindow={
		open:function(opener,bgLayer,floatWindow,content){
			$(floatWindow).css({'transform':'scale(0.8)', 'display':'none'});
			$(content).css({'display':'none'});
			function fw(){
				$(content).css({'display':'block'});
				$(floatWindow).fadeIn('fast');
				$(floatWindow).css({'transform':'scale(1)', 'z-index':'30'});
				return false;					
			}
			$(opener).click(function(e){
				$(bgLayer).fadeIn('fast');
				setTimeout(fw,50);
				return false;
			});			
			return false;
		},
		close:function(closer,bgLayer,floatWindow,content){
			$('body').keyup(function(e){
				if(e.keyCode==27){
					$(bgLayer).fadeOut('fast');
					$(floatWindow).fadeOut('fast');
					$(floatWindow).css({'transform':'scale(0.8)'});
					$(content).css({'display':'none'});
					return false;
				}
			});
			$(closer).click(function(e){
				$(bgLayer).fadeOut('fast');
				$(floatWindow).fadeOut('fast');
				$(floatWindow).css({'transform':'scale(0.8)'});
				$(content).css({'display':'none'});
				return false;			
			});
			$('html').click(function(e){
				$(bgLayer).fadeOut('fast');
				$(floatWindow).fadeOut('fast');
				$(floatWindow).css({'transform':'scale(0.8)', 'display':'none'});
				$(content).css({'display':'none'});
				return false;
			});			
			$(floatWindow).click(function(e){
				e.stopPropagation();
			});
			return false;
		},
		stopSelect:function(element){
			$(element).mousedown(function(e){
				return false;
			})
		}
	}

	floatWindow.stopSelect('.titleFloatWindow');
	floatWindow.stopSelect('#inner');

	floatWindow.open('#inscribeBtn','#dinamicContent','#topBar','#titleInscribe');
	floatWindow.close('.close','#dinamicContent','#topBar','#titleInscribe');
	floatWindow.open('#inscribeBtn','#dinamicContent','#floatWindow','#inscribe');
	floatWindow.close('.close','#dinamicContent','#floatWindow','#inscribe');

	floatWindow.open('ul.leftBarButtons a:nth-child(1)','#dinamicContent','#topBar','#titleConvocatoria');
	floatWindow.close('.close','#dinamicContent','#topBar','#titleConvocatoria');
	floatWindow.open('ul.leftBarButtons a:nth-child(1)','#dinamicContent','#floatWindow','#convocatorias');
	floatWindow.close('.close','#dinamicContent','#floatWindow','#convocatorias');


	floatWindow.open('ul.leftBarButtons a:nth-child(2)','#dinamicContent','#topBar','#titleBases');
	floatWindow.close('.close','#dinamicContent','#topBar','#titleBases');
	floatWindow.open('ul.leftBarButtons a:nth-child(2)','#dinamicContent','#floatWindow','#bases');
	floatWindow.close('#close','#dinamicContent','#floatWindow','#bases');

	floatWindow.open('ul.leftBarButtons a:nth-child(3)','#dinamicContent','#topBar','#titleHistorial');
	floatWindow.close('.close','#dinamicContent','#topBar','#titleHistorial');
	floatWindow.open('ul.leftBarButtons a:nth-child(3)','#dinamicContent','#floatWindow','#historial');
	floatWindow.close('#close','#dinamicContent','#floatWindow','#historial');

	floatWindow.open('ul.leftBarButtons a:nth-child(4)','#dinamicContent','#topBar','#titleTecoba');
	floatWindow.close('.close','#dinamicContent','#topBar','#titleTecoba');
	floatWindow.open('ul.leftBarButtons a:nth-child(4)','#dinamicContent','#floatWindow','#tecoba');
	floatWindow.close('#close','#dinamicContent','#floatWindow','#tecoba');

	floatWindow.open('ul.leftBarButtons a:nth-child(5)','#dinamicContent','#topBar','#titleComentarios');
	floatWindow.close('.close','#dinamicContent','#topBar','#titleComentarios');
	floatWindow.open('ul.leftBarButtons a:nth-child(5)','#dinamicContent','#floatWindow','#comentarios');
	floatWindow.close('#close','#dinamicContent','#floatWindow','#comentarios');

	$.backstretch("img/indexBg.jpg");
});