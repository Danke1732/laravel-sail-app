/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!******************************!*\
  !*** ./resources/js/main.js ***!
  \******************************/
function returnTop() {
  var returnBtn = document.querySelector('.return-top_btn');
  window.addEventListener('scroll', function () {
    if (200 < window.scrollY) {
      returnBtn.classList.remove('hidden');
    } else {
      returnBtn.classList.add('hidden');
    }
  });
}

window.addEventListener('DOMContentLoaded', returnTop);

function userSelectWindow() {
  try {
    var fixedItem = document.querySelector('.user-support-fixed');
    var normalItem = document.querySelector('.user-support');
    var clientRect = normalItem.getBoundingClientRect();
    window.addEventListener('scroll', function () {
      if (200 < window.scrollY && clientRect.top - window.innerHeight > window.scrollY) {
        fixedItem.classList.remove('hidden');
      } else {
        fixedItem.classList.add('hidden');
      }
    });
  } catch (e) {
    console.log();
  }
}

window.addEventListener('DOMContentLoaded', userSelectWindow);

function questionToggle() {
  var questions = document.querySelectorAll('.question-icon');
  addEventListener('click', function (e) {
    var elem = e.target.className;

    if (elem.includes('question-icon') === false) {
      questions.forEach(function (question) {
        question.nextElementSibling.classList.add('hidden');
      });
    }
  });

  for (var i = 0; i < questions.length; i++) {
    questions[i].addEventListener('click', function (e) {
      questions.forEach(function (question) {
        if (question.classList.contains('hidden') !== true) {
          question.nextElementSibling.classList.add('hidden');
        }
      });
      e.target.nextElementSibling.classList.toggle('hidden');
    });
  }
}

window.addEventListener('DOMContentLoaded', questionToggle);
/******/ })()
;