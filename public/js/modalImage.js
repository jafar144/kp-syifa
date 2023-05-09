// MODAL BAYAR
let modalBayar = document.getElementById("modalBayar");

// Get the image and insert it inside the modal - use its "alt" text as a caption
let imgBayar = document.getElementById("imgBayar");
let modalImgBayar = document.getElementById("img02");
let captionTextBayar = document.getElementById("captionBayar");
imgBayar.onclick = () => {
  modalImgBayar.style.animationName = "zoomin";
  modalBayar.style.display = "block";
  modalImgBayar.src = imgBayar.src;
  captionText.innerHTML = imgBayar.alt;
}

// Get the <span> element that closes the modal
let spanBayar = document.getElementsByClassName("closeBayar")[0];

// When the user clicks on <span> (x), close the modal
spanBayar.onclick = () => {
  modalImgBayar.style.animationName = "zoomout";
  setTimeout(function() {
    modalBayar.style.display = "none";
  }, 400);
}

// MODAL FOTO
let modal = document.getElementById("myModals");

// Get the image and insert it inside the modal - use its "alt" text as a caption
let img = document.getElementById("myImgs");
let modalImg = document.getElementById("img01");
let captionText = document.getElementById("caption");
img.onclick = () => {
  modalImg.style.animationName = "zoomin";
  modal.style.display = "block";
  modalImg.src = img.src;
  captionText.innerHTML = img.alt;
}

// Get the <span> element that closes the modal
let span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = () => {
  modalImg.style.animationName = "zoomout";
  setTimeout(function() {
    modal.style.display = "none";
  }, 400);
}