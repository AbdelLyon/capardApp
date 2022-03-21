# capardApp
Instalations
  1: installer toutes les dépendeces: npm i
  2: insataller bootstrap: npm i bootstrap
  3: installer node-sass et sass-loader en dev: npm i nodde-sass sass-loader --dev
  4: build les fichiers js et scss: npm run build 
Config
  1: décocher function  .enableSassLoader() dans webpack.config 
  2: rennomer le fichier app.css app.scss 
  2: importer bootstrap dans le fichirer app.scss: @import'~bootstrap/scss/bootstrap'
  3: modifier  la ligne import './styles/app.css' en import './styles/app.scss' dans app.js
  4: créer le fichier .env.dev.local à la racine et y ajouter la connexion à la db mysql
  
