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
const editBtn = document.querySelector('.edit_btn');
const editMode = document.querySelector('.is_edit');
const editInput = document.querySelector('.edit_input');
const editTextarea = document.querySelector('.edit_textarea');
const updateBtn = document.querySelector('.update_btn');

editBtn.addEventListener('click', () => {
  editBtn.style.cssText = "display: none;";
  updateBtn.style.cssText = "display: block;"
  // editMode.style.display = 'block';
  editInput.removeAttribute('disabled');
  editMode.style.cssText = 'cursor: pointer;';
  editInput.style.cssText = "pointer-events: auto;";
  editInput.style.opacity = 1;
  editTextarea.removeAttribute('disabled');
  editTextarea.style.cssText = "pointer-events: auto;";
  editTextarea.style.opacity = 1;
});
