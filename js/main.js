let oblact = document.querySelector('#oblact')
let form_control = document.querySelector('#form-control')
let form_select_selects = document.querySelector('#form-select_selects')

// Tuman tanlanganda MFY ro'yxatini bazadan olish
form_select_selects.addEventListener('change', function setStates() {
  form_control.style.display = 'none'
  oblact.style.display = 'inline-block'

    const tuman_nomi = (this.value || '').trim();
    
    if (!tuman_nomi || tuman_nomi === '-- Hudud tanlang --') {
	selectField = document.getElementById("oblact");
	selectField.options.length = 0;
        selectField.options[selectField.length] = new Option('-- MFY tanlang --', '', true, true);
        return;
    }

    // AJAX orqali bazadan MFY ro'yxatini olish
    $.ajax({
        url: 'ajaxdata.php',
        type: 'POST',
        data: {
            tuman_nomi: tuman_nomi
        },
        success: function(response) {
	selectField = document.getElementById("oblact");
            selectField.innerHTML = response;
        },
        error: function() {
	selectField = document.getElementById("oblact");
	selectField.options.length = 0;
            selectField.options[selectField.length] = new Option('-- MFY tanlang --', '', true, true);
            selectField.options[selectField.length] = new Option('Xatolik yuz berdi', '', false, false);
	}
    });
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



