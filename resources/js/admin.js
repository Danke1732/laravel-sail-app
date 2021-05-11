window.addEventListener('DOMContentLoaded', () => {
  const imageList = document.getElementById('image-content');
  let imageUrl = document.getElementById('image1');

  document.getElementById('image1').addEventListener('input', () => {
    const imageBefore = document.querySelector('.review-image');
    if (imageBefore) {
      imageBefore.remove();
    }

    function createImageHTML() {
      const imageDisplay = document.createElement('div');
      const image = document.createElement('img');
      image.setAttribute('src', file);
      image.setAttribute('class', 'review-image');
      imageDisplay.appendChild(image);
      imageList.appendChild(imageDisplay);
    }

    const file = imageUrl.value;
    createImageHTML(file);
  });
});

window.addEventListener('DOMContentLoaded', () => {
  const imageList = document.getElementById('image-content2');
  let imageUrl2 = document.getElementById('image2');

  document.getElementById('image2').addEventListener('input', () => {
    const imageBefore = document.querySelector('.review-image2');
    if (imageBefore) {
      imageBefore.remove();
    }

    function createImageHTML() {
      const imageDisplay = document.createElement('div');
      const image = document.createElement('img');
      image.setAttribute('src', file);
      image.setAttribute('class', 'review-image2');
      imageDisplay.appendChild(image);
      imageList.appendChild(imageDisplay);
    }

    const file = imageUrl2.value;
    createImageHTML(file);
  });
});