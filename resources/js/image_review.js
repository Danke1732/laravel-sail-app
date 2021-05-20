// 画像のinput処理
window.addEventListener('DOMContentLoaded', () => {
  const image1 = document.getElementById('image1');
  const image2 = document.getElementById('image2');
  const image3 = document.getElementById('image3');

  const labelImage1 = document.querySelector('label[for="image1"]');
  const labelImage2 = document.querySelector('label[for="image2"]');
  const labelImage3 = document.querySelector('label[for="image3"]');

  const imageView1 = document.getElementById('image-view1');
  const imageView2 = document.getElementById('image-view2');
  const imageView3 = document.getElementById('image-view3');

  // 画像１を入力した場合
  image1.addEventListener('change', (e) => {
    labelImage1.classList.add('hidden');
    imageView1.classList.remove('hidden');

    function createImageHTML() {
      const image = document.createElement('img');
      const span = document.createElement('span');
      image.setAttribute('src', blob);
      image.setAttribute('class', 'review-image');
      span.setAttribute('class', 'fas fa-times-circle d-inline-block delete1')
      imageView1.appendChild(image);
      imageView1.appendChild(span);
    }

    const file = e.target.files[0];
    const blob = window.URL.createObjectURL(file);
    createImageHTML(blob);
  });

  // 画像２を入力した場合
  image2.addEventListener('change', (e) => {
    labelImage2.classList.add('hidden');
    imageView2.classList.remove('hidden');

    function createImageHTML() {
      const image = document.createElement('img');
      const span = document.createElement('span');
      image.setAttribute('src', blob);
      image.setAttribute('class', 'review-image');
      span.setAttribute('class', 'fas fa-times-circle d-inline-block delete2')
      imageView2.appendChild(image);
      imageView2.appendChild(span);
    }

    const file = e.target.files[0];
    const blob = window.URL.createObjectURL(file);
    createImageHTML(blob);
  });

  // 画像３を入力した場合
  image3.addEventListener('change', (e) => {
    labelImage3.classList.add('hidden');
    imageView3.classList.remove('hidden');

    function createImageHTML() {
      const image = document.createElement('img');
      const span = document.createElement('span');
      image.setAttribute('src', blob);
      image.setAttribute('class', 'review-image');
      span.setAttribute('class', 'fas fa-times-circle d-inline-block delete3')
      imageView3.appendChild(image);
      imageView3.appendChild(span);
    }

    const file = e.target.files[0];
    const blob = window.URL.createObjectURL(file);
    createImageHTML(blob);
  });
});

// 入力した画像１を取り消すボタン(x)をクリックした時の処理
function imageDelete1() {
  const image1 = document.getElementById('image1');
  const labelImage1 = document.querySelector('label[for="image1"]');
  const imageView1 = document.getElementById('image-view1');
  const delete1 = document.querySelector('.delete1');

  try {
    delete1.addEventListener('click', (e) => {
      e.stopPropagation();

      image1.value = "";
      while (imageView1.firstChild) {
        imageView1.removeChild(imageView1.firstChild);
      }
      imageView1.classList.add('hidden');
      labelImage1.classList.remove('hidden');
    });
  } catch(e) {
    console.log();
  }
}
setInterval(imageDelete1, 1000);
// window.addEventListener('change', imageDelete1);

// 入力した画像２を取り消すボタン(x)をクリックした時の処理
function imageDelete2() {
  const image2 = document.getElementById('image2');
  const labelImage2 = document.querySelector('label[for="image2"]');
  const imageView2 = document.getElementById('image-view2');
  const delete2 = document.querySelector('.delete2');

  try {
    delete2.addEventListener('click', (e) => {
      e.stopPropagation();

      image2.value = "";
      while (imageView2.firstChild) {
        imageView2.removeChild(imageView2.firstChild);
      }
      imageView2.classList.add('hidden');
      labelImage2.classList.remove('hidden');
    });
  } catch(e) {
    console.log();
  }
}
setInterval(imageDelete2, 1000);
// window.addEventListener('change', imageDelete1);

// 入力した画像３を取り消すボタン(x)をクリックした時の処理
function imageDelete3() {
  const image3 = document.getElementById('image3');
  const labelImage3 = document.querySelector('label[for="image3"]');
  const imageView3 = document.getElementById('image-view3');
  const delete3 = document.querySelector('.delete3');

  try {
    delete3.addEventListener('click', (e) => {
      e.stopPropagation();

      image3.value = "";
      while (imageView3.firstChild) {
        imageView3.removeChild(imageView3.firstChild);
      }
      imageView3.classList.add('hidden');
      labelImage3.classList.remove('hidden');
    });
  } catch(e) {
    console.log();
  }
}
setInterval(imageDelete3, 1000);
// window.addEventListener('change', imageDelete1);

function imageDetail1() {
  const imageView1 = document.getElementById('image-view1');
  const mask = document.getElementById('mask');
  const imageDetail = document.getElementById('image-detail');

  try {
    imageView1.addEventListener('click', (e) => {

      if (imageView1.getAttribute('data-load') != null) {
        return null;
      }
      imageView1.setAttribute('data-load', 'true');
  
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
      imageView1.removeAttribute('data-load');
    });

    imageDetail.addEventListener('click', () => {
      if (imageDetail.firstChild) {
        imageDetail.removeChild(imageDetail.firstChild)
      }
      mask.classList.remove('visible');
      imageDetail.classList.add('hidden');
      imageView1.removeAttribute('data-load');
    });
  } catch(e) {
    console.log()
  }
}
setInterval(imageDetail1, 1000);

function imageDetail2() {
  const imageView2 = document.getElementById('image-view2');
  const mask = document.getElementById('mask');
  const imageDetail = document.getElementById('image-detail');

  try {
    imageView2.addEventListener('click', (e) => {

      if (imageView2.getAttribute('data-load') != null) {
        return null;
      }
      imageView2.setAttribute('data-load', 'true');
  
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
      imageView2.removeAttribute('data-load');
    });

    imageDetail.addEventListener('click', () => {
      if (imageDetail.firstChild) {
        imageDetail.removeChild(imageDetail.firstChild)
      }
      mask.classList.remove('visible');
      imageDetail.classList.add('hidden');
      imageView2.removeAttribute('data-load');
    });
  } catch(e) {
    console.log()
  }
}
setInterval(imageDetail2, 1000);

function imageDetail3() {
  const imageView3 = document.getElementById('image-view3');
  const mask = document.getElementById('mask');
  const imageDetail = document.getElementById('image-detail');

  try {
    imageView3.addEventListener('click', (e) => {

      if (imageView3.getAttribute('data-load') != null) {
        return null;
      }
      imageView3.setAttribute('data-load', 'true');
  
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
      imageView3.removeAttribute('data-load');
    });

    imageDetail.addEventListener('click', () => {
      if (imageDetail.firstChild) {
        imageDetail.removeChild(imageDetail.firstChild)
      }
      mask.classList.remove('visible');
      imageDetail.classList.add('hidden');
      imageView3.removeAttribute('data-load');
    });
  } catch(e) {
    console.log()
  }
}
setInterval(imageDetail3, 1000);