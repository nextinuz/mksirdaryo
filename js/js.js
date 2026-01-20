
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

  // Получаем выбранное значение из select

  // Проверяем условия (например, что оба поля не пустые)
  if (
    fishValue.trim() === '' ||
    telValue === '+998(__)___-__-__' ||
    hududValue === '-- Hudud tanlang --' ||
    manzilValue.trim() === '' ||
    nashrTuriValue === '-- tanlang --'
  ){
    tel.classList.add('input_error')
    fish.classList.add('input_error')
    tumanlar.classList.add('input_error')
    manzil.classList.add('input_error')
    nashr_t.classList.add('input_error')
    // Если условие не выполнено, предотвращаем отправку формы
    alert('Iltimos, barcha maydonlarni to\'ldiring va telefon raqamini kiriting.')
    event.preventDefault();
  }
  // Иначе форма будет отправлена
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
       $('#obuna_davri').html(`
          <option selected disabled>-- tanlang --</option>
          <option value="12">12 oy</option>
          <option value="6">6 oy</option>
        `);  
       $('#komplektlar_soni').val('');
    }

  })
}


function Nashr(id){ 
  $.ajax({
    type:'post',
    url: 'ajaxdata.php',
    dataType : "json",
    data : { nashr : id},
    success : function(data){
       $('#nashr_index').html(data.indeks);
       $('#nashr_narxi').html(data.butun);
       $('#obuna_davri').html(`
          <option selected disabled>-- tanlang --</option>
          <option value="12">12 oy</option>
          <option value="6">6 oy</option>
        `); 
       $('#komplektlar_soni').val('');  
    }
  })
}


function Obuna(id) {
  $.ajax({
    type : 'post',
    url: 'ajaxdata.php',
    data : { obuna_davri : id},
    success : function(data){
       $('#nashr_narxi').html(data);
       $('#komplektlar_soni').val('');  
    }    
  })
}


function Komplect(id) {
  $.ajax({
    type : 'post',
    url: 'ajaxdata.php',
    data : { komplektlar_soni : id},
    success : function(data){
       $('#nashr_narxi').html(data);
    }    
  })
}

