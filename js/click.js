
// Telefon maskasini toza boshqarish: kursor har doim birinchi bo'sh pozitsiyada
window.addEventListener("DOMContentLoaded", function() {
  const maskTemplate = '+998(__)___-__-__';

  function setCursor(input, pos) {
    if (input.setSelectionRange) {
      input.setSelectionRange(pos, pos);
    }
  }

  function format(value) {
    let digits = value.replace(/\D/g, '');
    const template = maskTemplate;
    let i = 0;
    const filled = template.replace(/[_\d]/g, () => digits[i++] || '_');
    const nextPos = filled.indexOf('_') !== -1 ? filled.indexOf('_') : filled.length;
    return { filled, nextPos };
  }

  function applyMask(input) {
    return function(e) {
      const { filled, nextPos } = format(input.value);
      input.value = filled;
      setCursor(input, nextPos);
    };
  }

  function initMask(input) {
    if (!input) return;

    // Boshlang'ich qiymat va kursor
    input.value = maskTemplate;
    setCursor(input, maskTemplate.indexOf('_'));

    input.addEventListener('focus', function() {
      const firstEmpty = input.value.indexOf('_');
      setCursor(input, firstEmpty !== -1 ? firstEmpty : input.value.length);
    });

    input.addEventListener('input', applyMask(input), false);
  }

  // Asosiy forma telefon inputi
  const mainInput = typeof tel !== 'undefined' ? tel : document.querySelector('#leister');
  initMask(mainInput);

  // Modal telefon inputi
  const modalInput = document.querySelector('#phone');
  if (modalInput) {
    // Modal ochilganda maska qo'shish
    const modal = document.querySelector('#staticBackdrop');
    if (modal) {
      modal.addEventListener('shown.bs.modal', function() {
        initMask(modalInput);
      });
    }
  }
});