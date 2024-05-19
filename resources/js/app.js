import './bootstrap';

import Alpine from 'alpinejs';
// import flatpickr from 'flatpickr';

window.Alpine = Alpine;

Alpine.start();

// const config = {
//   enableTime: true,
//   dateFormat: "Y-m-d H:i",
// }
// flatpickr('.flatpickr', config);

const categoryName = document.querySelector('.category_name');
const editMode = document.querySelector('.is_edit');

categoryName.addEventListener('click', () => {
  editMode.style.display = 'block';
  categoryName.style.display = 'none';
});