import '@fortawesome/fontawesome-free/css/all.min.css';
import '@fortawesome/fontawesome-free/js/all.js';
<<<<<<< HEAD
import './bootstrap';
=======

>>>>>>> cab800a67f6f5da9315e0808a6a14833a3d9b183
import './styles/app.scss';
import './javascripts/shop/shop';



<<<<<<< HEAD
// const btnId = document.querySelector('.btn-id');
// const contentId = document.querySelectorAll('.content-id');

const folderProduct = document.querySelector('#folder-product');
const subfolderProduct = document.querySelector('#subfolder-product');
const folderCategory = document.querySelector('#folder-category');
const subfolderCategory = document.querySelector('#subfolder-category');
const folderSubcategory = document.querySelector('#folder-subcategory');
const subfolderSubcategory = document.querySelector('#subfolder-subcategory');


const folderToggle = (folder, subfolder) => folder.addEventListener('click', () => {
  subfolder.classList.toggle('d-none');

  folder.querySelectorAll('.angle').forEach(f => {
    f.classList.toggle('fa-angle-right')
    f.classList.toggle('fa-angle-down')
  })

  folder.querySelectorAll('.folder').forEach(f => {
    f.classList.toggle('fa-folder')
    f.classList.toggle('fa-folder-open')
  })

});

folderToggle(folderProduct, subfolderProduct);
folderToggle(folderCategory, subfolderCategory);
folderToggle(folderSubcategory, subfolderSubcategory);
=======
>>>>>>> cab800a67f6f5da9315e0808a6a14833a3d9b183
