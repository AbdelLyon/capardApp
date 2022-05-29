
// const btnId = document.querySelector('.btn-id');
// const contentId = document.querySelectorAll('.content-id');
const folderProduct = document.querySelector('#folder-product');
const subfolderProduct = document.querySelector('#subfolder-product');
const folderCategory = document.querySelector('#folder-category');
const subfolderCategory = document.querySelector('#subfolder-category');
const folderSubcategory = document.querySelector('#folder-subcategory');
const subfolderSubcategory = document.querySelector('#subfolder-subcategory');
const navbarTogglerIcon = document.querySelector('.navbar-toggler-icon');
const navbarTogglerModal = document.querySelector('.modal-toggler-modal');


navbarTogglerIcon.addEventListener('click', () => {
  navbarTogglerModal.querySelector('.modal-nav-items').classList.toggle('d-none');
})


const toggleClass = (folder, param1, param2, param3) => {
  folder.querySelectorAll(param1).forEach(f => {
    f.classList.toggle(param2)
    f.classList.toggle(param3)
  })
}

const folderToggle = (folder, subfolder) => folder.addEventListener('click', () => {
  subfolder.classList.toggle('d-none');
  toggleClass(folder, '.angle', 'fa-angle-right', 'fa-angle-down')
  toggleClass(folder, '.folder', 'fa-folder', 'fa-folder-open')
});

folderToggle(folderProduct, subfolderProduct);
folderToggle(folderCategory, subfolderCategory);
folderToggle(folderSubcategory, subfolderSubcategory);