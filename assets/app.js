import '@fortawesome/fontawesome-free/css/all.min.css';
import '@fortawesome/fontawesome-free/js/all.js';
import './bootstrap';
import './styles/app.scss';
import './javascripts/shop/shop';



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
