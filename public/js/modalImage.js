// Get the modal
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