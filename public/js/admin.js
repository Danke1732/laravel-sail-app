/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************!*\
  !*** ./resources/js/admin.js ***!
  \*******************************/
window.addEventListener('DOMContentLoaded', function () {
  var imageList = document.getElementById('image-content');
  var imageUrl = document.getElementById('image1');
  document.getElementById('image1').addEventListener('input', function () {
    var imageBefore = document.querySelector('.review-image');

    if (imageBefore) {
      imageBefore.remove();
    }

    function createImageHTML() {
      var imageDisplay = document.createElement('div');
      var image = document.createElement('img');
      image.setAttribute('src', file);
      image.setAttribute('class', 'review-image');
      imageDisplay.appendChild(image);
      imageList.appendChild(imageDisplay);
    }

    var file = imageUrl.value;
    createImageHTML(file);
  });
});
window.addEventListener('DOMContentLoaded', function () {
  var imageList = document.getElementById('image-content2');
  var imageUrl2 = document.getElementById('image2');
  document.getElementById('image2').addEventListener('input', function () {
    var imageBefore = document.querySelector('.review-image2');

    if (imageBefore) {
      imageBefore.remove();
    }

    function createImageHTML() {
      var imageDisplay = document.createElement('div');
      var image = document.createElement('img');
      image.setAttribute('src', file);
      image.setAttribute('class', 'review-image2');
      imageDisplay.appendChild(image);
      imageList.appendChild(imageDisplay);
    }

    var file = imageUrl2.value;
    createImageHTML(file);
  });
});
/******/ })()
;