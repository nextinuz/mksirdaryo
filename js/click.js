
// Telefon maskasini toza boshqarish: kursor har doim birinchi bo'sh pozitsiyada
window.addEventListener("DOMContentLoaded", function() {
  const input = typeof tel !== 'undefined' ? tel : document.querySelector('#leister');
  if (!input) return;

  const maskTemplate = '+998(__)___-__-__';

  function setCursor(pos) {
    input.setSelectionRange(pos, pos);
  }

  function format(value) {
    let digits = value.replace(/\D/g, '');
    const template = maskTemplate;
    let i = 0;
    const filled = template.replace(/[_\d]/g, () => digits[i++] || '_');
    const nextPos = filled.indexOf('_') !== -1 ? filled.indexOf('_') : filled.length;
    return { filled, nextPos };
  }

  function applyMask(e) {
    const { filled, nextPos } = format(input.value);
    input.value = filled;
    setCursor(nextPos);
  }

  // Boshlang'ich qiymat va kursor
  input.value = maskTemplate;
  setCursor(maskTemplate.indexOf('_'));

  input.addEventListener('focus', function() {
    const firstEmpty = input.value.indexOf('_');
    setCursor(firstEmpty !== -1 ? firstEmpty : input.value.length);
  });

  input.addEventListener('input', applyMask, false);
});