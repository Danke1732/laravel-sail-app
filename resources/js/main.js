function returnTop() {
  const returnBtn = document.querySelector('.return-top_btn');

  window.addEventListener('scroll', () => {
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
    const fixedItem = document.querySelector('.user-support-fixed');
    const normalItem = document.querySelector('.user-support');
    let clientRect = normalItem.getBoundingClientRect();

    window.addEventListener('scroll', () => {
      if (200 < window.scrollY && ((clientRect.top - window.innerHeight) > window.scrollY)) {
        fixedItem.classList.remove('hidden');
      } else {
        fixedItem.classList.add('hidden');
      }
    });
  } catch(e) {
    console.log();
  }
  
}
window.addEventListener('DOMContentLoaded', userSelectWindow);

function questionToggle() {
  let questions = document.querySelectorAll('.question-icon');

  addEventListener('click', (e) => {
    let elem = e.target.className;
    if (elem.includes('question-icon') === false) {
      questions.forEach((question) => {
        question.nextElementSibling.classList.add('hidden');
      });
    }
  });

  for(let i = 0; i < questions.length; i++) {
    questions[i].addEventListener('click', (e) => {
      questions.forEach((question) => {
        if (question.classList.contains('hidden') !== true) {
          question.nextElementSibling.classList.add('hidden');
        }
      });
      e.target.nextElementSibling.classList.toggle('hidden');
    });
  }

}
window.addEventListener('DOMContentLoaded', questionToggle);