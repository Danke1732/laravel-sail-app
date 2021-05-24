window.addEventListener('DOMContentLoaded', () => {

  let minusChecks = document.querySelectorAll('.minus-check');

  minusChecks.forEach((check) => {
    cardMinusCheck(check);
  });

  function cardMinusCheck(value) {
    let checkContent = value.textContent;
    if (checkContent < 0) {
      value.classList.add('minus');
      let valueAfter = value.nextElementSibling;
      valueAfter.classList.add('minus');
    } else {
      value.classList.remove('minus');
      let valueAfter = value.nextElementSibling;
      valueAfter.classList.remove('minus');
    }
  }
});

window.addEventListener('DOMContentLoaded', () => {
  const mask = document.getElementById('mask');
  const imageDetail = document.getElementById('image-detail');
  let cardImages = document.querySelectorAll('.card-image');

  for (i = 0; i < cardImages.length; i++) {
    cardImages[i].addEventListener('click', (e) => {
      e.preventDefault();

      function createImageHTML() {
        const image = document.createElement('img');
        image.setAttribute('src', file);
        imageDetail.appendChild(image);
      }

      const file = e.target.getAttribute('src');
      createImageHTML(file);

      mask.classList.add('visible');
      imageDetail.classList.remove('hidden');

    });

    mask.addEventListener('click', () => {
      if (imageDetail.firstChild) {
        imageDetail.removeChild(imageDetail.firstChild)
      }
      mask.classList.remove('visible');
      imageDetail.classList.add('hidden');
    });

    imageDetail.addEventListener('click', () => {
      if (imageDetail.firstChild) {
        imageDetail.removeChild(imageDetail.firstChild)
      }
      mask.classList.remove('visible');
      imageDetail.classList.add('hidden');
    });
  }

});
