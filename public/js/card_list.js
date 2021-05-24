/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***********************************!*\
  !*** ./resources/js/card_list.js ***!
  \***********************************/
window.addEventListener('DOMContentLoaded', function () {
  var minusChecks = document.querySelectorAll('.minus-check');
  minusChecks.forEach(function (check) {
    cardMinusCheck(check);
  });

  function cardMinusCheck(value) {
    var checkContent = value.textContent;

    if (checkContent < 0) {
      value.classList.add('minus');
      var valueAfter = value.nextElementSibling;
      valueAfter.classList.add('minus');
    } else {
      value.classList.remove('minus');
      var _valueAfter = value.nextElementSibling;

      _valueAfter.classList.remove('minus');
    }
  }
});
window.addEventListener('DOMContentLoaded', function () {
  var mask = document.getElementById('mask');
  var imageDetail = document.getElementById('image-detail');
  var cardImages = document.querySelectorAll('.card-image');

  for (i = 0; i < cardImages.length; i++) {
    cardImages[i].addEventListener('click', function (e) {
      e.preventDefault();

      function createImageHTML() {
        var image = document.createElement('img');
        image.setAttribute('src', file);
        imageDetail.appendChild(image);
      }

      var file = e.target.getAttribute('src');
      createImageHTML(file);
      mask.classList.add('visible');
      imageDetail.classList.remove('hidden');
    });
    mask.addEventListener('click', function () {
      if (imageDetail.firstChild) {
        imageDetail.removeChild(imageDetail.firstChild);
      }

      mask.classList.remove('visible');
      imageDetail.classList.add('hidden');
    });
    imageDetail.addEventListener('click', function () {
      if (imageDetail.firstChild) {
        imageDetail.removeChild(imageDetail.firstChild);
      }

      mask.classList.remove('visible');
      imageDetail.classList.add('hidden');
    });
  }
});
/******/ })()
;