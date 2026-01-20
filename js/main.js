let oblact = document.querySelector('#oblact')
let form_control = document.querySelector('#form-control')
let form_select_selects = document.querySelector('#form-select_selects')

let guliston_sh = new Array();
let shirin = new Array();
let yangiyer_sh = new Array(); 
let guliston_tuman = new Array(); 
let sardoba = new Array(); 
let sirdaryo_tumani = new Array(); 
let boyovut_tumani = new Array(); 
let hovos_tumani = new Array(); 
let sayhudnobod_tumani = new Array(); 
let oqoltin_tumani = new Array(); 
let mehnatobod_tumani = new Array(); 
let mirzabod_tumani = new Array(); 

// Tuman nomi -> MFY ro'yxati map
const mfyMap = {
  'Гулистон шахри': guliston_sh['India'],
  'Янгиер шахри': yangiyer_sh['yangiyer_sh'],
  'Ширин шахри': shirin['shirin'],
  'Боёвут тумани': boyovut_tumani['boyovut_tumani'],
  'Гулистон тумани': guliston_tuman['guliston_tuman'],
  'Мирзобод тумани': mirzabod_tumani['mirzabod_tumani'],
  'Околтин тумани': oqoltin_tumani['oqoltin_tumani'],
  'Сайхунобод тумани': sayhudnobod_tumani['sayhudnobod_tumani'],
  'Сардоба тумани': sardoba['sardoba'],
  'Сирдарё тумани': sirdaryo_tumani['sirdaryo_tumani'],
  'Ховос тумани': hovos_tumani['hovos_tumani'],
};
 
guliston_sh['India'] = new Array('"Ахиллик" МФЙ','"Дўстлик" МФЙ','"Навбахор" МФЙ','"Нурафшон" МФЙ','"Сохил" МФЙ','"Шодлик" МФЙ','"Янги хаёт" МФЙ','"Бахт" МФЙ','"Бўстон" МФЙ','"Буюк келажак" МФЙ','"Истиқлол" МФЙ','"Улуғобод" МФЙ','"Боғишамол" МФЙ','"Намуна" МФЙ','"Обод юрт" МФЙ','"Сайқал" МФЙ','"Тараққиёт" МФЙ','"Бахор" МФЙ','"Ибратли" МФЙ','"Маданият" МФЙ','"Маънавият" МФЙ','"Нихол" МФЙ','"Улуғ йўл" МФЙ','"Юксалиш" МФЙ',); 
shirin['shirin'] = new Array('"Дўстлик"  МФЙ', 'Амир Темур  МФЙ', 'Мирзо Улуғбек  МФЙ','"Бунёдкор" МФЙ','"Фарҳод"  МФЙ','"Нуробод"  МФЙ','"Ватанпарвар"  МФЙ') 
yangiyer_sh['yangiyer_sh'] = new Array('З.Бобур номли МФЙ','Т.Малик номли МФЙ','А.Жомий номли МФЙ','Шукрона МФЙ','Фазилат МФЙ','Давлатобод МФЙ','Шодиёна МФЙ','Маърифат МФЙ','Юксалиш МФЙ','Бинокор МФЙ','Наврўзобод МФЙ'); 
guliston_tuman['guliston_tuman'] = new Array('Бахмал МФЙ','Зарбдор МФЙ','Ишонч МФЙ','Мевазор МФЙ','Оқ олтин МФЙ','Сойибобод ҚФЙ','Тажрибакор МФЙ','Х. Олимжон номли МФЙ','Юлдуз МФЙ','Боёвут МФЙ','Олтин водий МФЙ','Сохил МФЙ','Сохилобод ҚФЙ','Теракзор  МФЙ','Фурқат номли МФЙ','Шарқ хақиқати МФЙ','Бешбулоқ ҚФЙ','Мустақиллик МФЙ','Чортоқ ҚФЙ','А.Навоий номли МФЙ','А.Яссавий номли МФЙ','Ахиллик МФЙ','Бирлашган МФЙ','Дўстлик МФЙ','Ибрат МФЙ'); 
sirdaryo_tumani['sirdaryo_tumani'] = new Array('"Бахмал" МФЙ','"Бунёдкор" МФЙ','"Камолат" МФЙ','"Тараққиёт" МФЙ','Улуғбек номли МФЙ','"Ҳикматли" МФЙ','"Адолат" МФЙ','"Дўстлик" МФЙ','"Ишонч" МФЙ','"Тадбиркор" МФЙ','"Ахиллик" МФЙ','"Истиқбол" МФЙ','"Орзу" МФЙ','"Тинчлик" МФЙ','"Туркистон" МФЙ','"Хазина" МФЙ','"Янгиобод" МФЙ','"Дехқонобод" МФЙ','Навоий номли МФЙ','"Заршунос" МФЙ','"Илғор" МФЙ','"Интилиш" МФЙ','"Қуёш" МФЙ','"Наврўз" МФЙ','"Оқ йўл" МФЙ','"Фаравон" МФЙ','"Фурқат" МФЙ','"Шоликор" МФЙ','"Элобод" МФЙ','"Ширин" МФЙ','"Ёшлик" МФЙ','"Бахор" МФЙ','"Бешбулоқ" МФЙ','"Зиёкор" МФЙ','"Исломобод" МФЙ','"Матонат" МФЙ','"Пахтакор" МФЙ','"Оқибат" МФЙ'); 
boyovut_tumani['boyovut_tumani'] = new Array('"Фарход" МФЙ','"Наврўз" МФЙ','"Анорзор" МФЙ','"Бекат" МФЙ','"Қарапчи" МФЙ','"Лайлаккўл" МФЙ','Мукумий  МФЙ','"Бобоюрт" МФЙ','"Марказ"  МФЙ','"Пахтакор" МФЙ','"Ўзбекистон" МФЙ','"Озодлик" МФЙ','"Истиқлол" МФЙ','"Гулбог" МФЙ','"Ифтихор" МФЙ','"Янги авлод" МФЙ','"Ижодкор"  МФЙ','"Учтургон"  МФЙ','"Маънавият"  МФЙ','"Сармич"  МФЙ','"Жўлангар"  МФЙ','А.Навоий номли МФЙ','"Тинчлик"  МФЙ','"Маданият" МФЙ','"Сохил" МФЙ','"Миришкор" МФЙ','"Бунёдкор" МФЙ','У.Юсупов номли МФЙ','"Янги бўстон" МФЙ','"Дўстлик" МФЙ','С.Айний номли МФЙ','А.Темур номли МФЙ','"Янгиобод" МФЙ','Беруний номли МФЙ','"Олмазор" МФЙ','"Совотобод" МФЙ','"Зиёкор" МФЙ','"Навбахор" МФЙ','"Ширин" МФЙ'); 
hovos_tumani['hovos_tumani'] = new Array('Чаманзор  МФЙ','Истиқлол  МФЙ','Дўстлик  МФЙ','Тинчлик  МФЙ','Бунёдкор  МФЙ','Янгиер МФЙ','Пахтакор МФЙ','Фарход МФЙ','Обод турмуш  МФЙ','Гулбаҳор  МФЙ','Мустақилликнинг 25 йиллиги  МФЙ','Қайирма  МФЙ','Шарқобод  МФЙ','Соҳибкор МФЙ','Қорақум МФЙ','Нурли келажак МФЙ','Мустақиллик  МФЙ','Оқчангал МФЙ','Афросиёб МФЙ','Ўзбекистон тўкинчилиги МФЙ','Ҳавособод  МФЙ','Карвонсарой   МФЙ','Етти гузар  МФЙ','Қаҳрамон МФЙ','Ҳуснобод МФЙ','Бўстон МФЙ','Бинокор МФЙ'); 
sardoba['sardoba'] = new Array('"Юртдош" МФЙ','"Дўстлик" МФЙ','"Қўрғонтепа" МФЙ','"Отаюрт" МФЙ','"Бирлик" МФЙ','"Янгиқишлоқ" МФЙ','"Халқаобод" МФЙ','"Қуйитош" МФЙ','"Файзлиобод" МФЙ','"Наврўз" МФЙ','"Пахтакор" МФЙ','"Бирлашган" МФЙ','"Зомин" МФЙ','"Ровот" МФЙ','"Бўстон" МФЙ',)
sayhudnobod_tumani['sayhudnobod_tumani'] = new Array('Бахмалсой МФЙ','Нурли йўл МФЙ','Паймард МФЙ','Ўзбекистон МФЙ','Фаровон МФЙ','Иттифоқ МФЙ','Нуробод МФЙ','Олғабос МФЙ','Пахтаобод МФЙ','Шодлик МФЙ','Турон МФЙ','Гулбулоқ МФЙ','Пахтакон МФЙ','Дўстлик МФЙ','Синтоб МФЙ','Гулистон МФЙ','Мустақиллик МФЙ','Ўрикзор МФЙ','Янги ҳаёт МФЙ'); 
oqoltin_tumani['oqoltin_tumani'] = new Array('А.Навоий номли МФЙ','"Саҳоват" МФЙ','"Шодлик" МФЙ','"Кўркам диёр" МФЙ','"Аҳиллик" МФЙ','"Бўстон" МФЙ','"Обод" МФЙ','"Янги хаёт" МФЙ','"Тошкент" МФЙ','"Мустақиллик" МФЙ','"Янги давр" МФЙ','"Андижон" МФЙ','"Янги Тошкент" МФЙ'); 
mirzabod_tumani['mirzabod_tumani'] = new Array('"Бахористон" МФЙ','"Йўлдошобод" МФЙ','"Навбахор" МФЙ','"Ҳақиқат" МФЙ','"Янги Ўзбекистон" МФЙ','"Боғистон" МФЙ','"Дўнгариқ" МФЙ','"Наврўз" МФЙ','"Нурарафшон" МФЙ','"Мирзачўл" МФЙ','"Дехқонобод" МФЙ','"Ойдин" МФЙ','"Оқолтин" МФЙ','Т.Ахмедов номли МФЙ','"Тинчлик" МФЙ','"Тошкент" МФЙ','М.Улуғбек номли МФЙ','"Янгихаёт" МФЙ');



form_select_selects.addEventListener('change', 
function setStates(){
  form_control.style.display = 'none'
  oblact.style.display = 'inline-block'

  const key = (this.value || '').trim();
  const options = mfyMap[key] || [];
  selectField = document.getElementById("oblact");
  selectField.options.length = 0;
  // placeholder
  selectField.options[selectField.length] = new Option('-- MFY tanlang --', '', true, true);
  for (i=0; i<options.length; i++)
  {
    selectField.options[selectField.length] = new Option(options[i], options[i]);
  }
    
})



// Tashkilot uchun yozilgan funksiya

let toifa = document.querySelector('#tashk');
let tashkilot = document.querySelector('#tashk_input');

toifa.addEventListener('change', function() {
	if (this.value == 'Yuridik shahs') {
		tashkilot.style.display = "block"
	} else {
		tashkilot.style.display = "none"		
	}
})


// Chek uchun yozilgan funksiya

let chek = document.querySelector('#chek')
let nashr = document.querySelector('#nashr')

nashr.addEventListener('change', function() {
	
		if (this.value != ""){
			chek.style.display = "block"
		} else {
			chek.style.display = "none"
		}

})


let modal_mfy = document.querySelector('#modal_mfy')
let nashr_turi = document.querySelector('#nashr_turi')
let modal_nashr = document.querySelector('#modal_nashr')

form_select_selects.addEventListener('change' , function() {
	if (this.value != "-- Hudud tanlang --") {
		modal_mfy.style.display = "block"
	} 
})


nashr_turi.addEventListener('change', function() {
	if (this.value != '-- tanlang --') {
		modal_nashr.style.display = "block"
	}
})



