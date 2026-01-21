
let form2 = document.querySelector('#form2')
let fish = document.querySelector('#fish')
let tel = document.querySelector('#leister')
let tumanlar = document.querySelector('#form-select_selects')
let manzil = document.querySelector('.manzil')
let nashr_t = document.querySelector('#nashr_turi')

// form2.onsubmit = function () {
//   if (fish.value === "" && tel.value === "+998(__)___-__-__") {
//     tel.classList.add('input_error')
//     fish.classList.add('input_error')
//     tumanlar.classList.add('input_error')
//     manzil.classList.add('input_error')
//     nashr_t.classList.add('input_error')
//     alert('Biz siz bilan bog\'lanishimiz uchun. Marhamat! Ismingiz va telefon raqamingizni kiriting.')


//     return false
//   } 
// }





function validateForm(event) {
  // Получаем значение из инпута
  let fishValue = document.getElementById('fish').value;
  let telValue = document.getElementById('leister').value;
  let hududValue = document.getElementById('form-select_selects').value;
  let manzilValue = document.querySelector('.manzil').value;
  let nashrTuriValue = document.getElementById('nashr_turi').value;
  let nashrNomiValue = document.getElementById('nashr').value;
  let nashrNomiSelect = document.getElementById('nashr');

  // Проверяем условия (например, что оба поля не пустые)
  let hasError = false;
  
  if (fishValue.trim() === '') {
    fish.classList.add('input_error');
    hasError = true;
  } else {
    fish.classList.remove('input_error');
  }
  
  if (telValue === '+998(__)___-__-__' || telValue.trim() === '') {
    tel.classList.add('input_error');
    hasError = true;
  } else {
    tel.classList.remove('input_error');
  }
  
  if (hududValue === '-- Hudud tanlang --' || hududValue === '') {
    tumanlar.classList.add('input_error');
    hasError = true;
  } else {
    tumanlar.classList.remove('input_error');
  }
  
  if (manzilValue.trim() === '') {
    manzil.classList.add('input_error');
    hasError = true;
  } else {
    manzil.classList.remove('input_error');
  }
  
  if (nashrTuriValue === '-- tanlang --' || nashrTuriValue === '') {
    nashr_t.classList.add('input_error');
    hasError = true;
  } else {
    nashr_t.classList.remove('input_error');
  }
  
  // Nashr nomi tanlanishini tekshirish
  if (!nashrNomiValue || nashrNomiValue === '' || nashrNomiValue === '-- tanlang --') {
    if (nashrNomiSelect) {
      nashrNomiSelect.classList.add('input_error');
    }
    hasError = true;
  } else {
    if (nashrNomiSelect) {
      nashrNomiSelect.classList.remove('input_error');
    }
  }
  
  if (hasError) {
    // Если условие не выполнено, предотвращаем отправку формы
    alert('Iltimos, barcha maydonlarni to\'ldiring, nashr nomini tanlang va telefon raqamini kiriting.')
    event.preventDefault();
    return false;
  }
  
  // Иначе форма будет отправлена
  return true;
}






function NashrBosilganda(id){
  $.ajax({
    type:'post',
    url: 'ajaxdata.php',
    data : { nashr_turi : id},
    success : function(data){
       $('#nashr').html(data);
       $('#nashr_index').html('');
       $('#nashr_narxi').html('');
       $('#obuna_davri_text').html('');
       $('#obuna_davri').html(`
          <option selected disabled value="">-- tanlang --</option>
          <option value="12">12 oy</option>
          <option value="6">6 oy</option>
        `);  
       $('#komplektlar_soni').val('');
       $('#komplektlar_container').hide();
    }

  })
}


// Raqamlarni financial formatda ko'rsatish funksiyasi
function formatNumber(num) {
  if (!num || num === 0) return '0';
  return parseFloat(num).toLocaleString('uz-UZ', {
    minimumFractionDigits: 0,
    maximumFractionDigits: 0
  });
}

function Nashr(id){ 
  $.ajax({
    type:'post',
    url: 'ajaxdata.php',
    dataType : "json",
    data : { nashr : id},
    success : function(data){
       $('#nashr_index').html(data.indeks);
       // Boshlang'ich narx 12 oylik obuna davri uchun
       $('#nashr_narxi').html(formatNumber(data.butun));
       $('#obuna_davri_text').html('(12 oy uchun)');
       $('#obuna_davri').html(`
          <option selected disabled value="">-- tanlang --</option>
          <option value="12">12 oy</option>
          <option value="6">6 oy</option>
        `); 
       $('#komplektlar_soni').val('');
       $('#komplektlar_container').hide();
    }
  })
}


function Obuna(id) {
  // Agar "Obuna davri" tanlanmagan bo'lsa, "Komplektlar soni" ni yashirish
  if (!id || id === '') {
    $('#komplektlar_container').hide();
    $('#komplektlar_soni').val('');
    $('#nashr_narxi').html('');
    $('#obuna_davri_text').html('');
    return;
  }
  
  // "Obuna davri" tanlanganda "Komplektlar soni" ni ko'rsatish
  $('#komplektlar_container').show();
  
  // Obuna davri matnini o'rnatish
  const davriText = id === '6' ? '(6 oy uchun)' : '(12 oy uchun)';
  
  $.ajax({
    type : 'post',
    url: 'ajaxdata.php',
    data : { obuna_davri : id},
    success : function(data){
       $('#nashr_narxi').html(formatNumber(data));
       $('#obuna_davri_text').html(davriText);
       $('#komplektlar_soni').val('');  
    }    
  })
}


function Komplect(id) {
  // Agar "Obuna davri" tanlanmagan bo'lsa, hisoblamaslik
  const obunaDavri = $('#obuna_davri').val();
  if (!obunaDavri || obunaDavri === '') {
    return;
  }
  
  // Agar komplektlar soni 0 yoki bo'sh bo'lsa, narxni tozalash
  if (!id || id <= 0) {
    // Obuna davri narxini ko'rsatish
    Obuna(obunaDavri);
    return;
  }
  
  // Obuna davri matnini saqlash
  const davriText = obunaDavri === '6' ? '(6 oy uchun)' : '(12 oy uchun)';
  
  $.ajax({
    type : 'post',
    url: 'ajaxdata.php',
    data : { komplektlar_soni : id},
    success : function(data){
       $('#nashr_narxi').html(formatNumber(data));
       $('#obuna_davri_text').html(davriText);
    }    
  })
}

