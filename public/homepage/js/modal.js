
var popupList = document.getElementsByClassName("filter__item__name");

var modalList = document.getElementsByClassName("modal-opacity");

var closeBtnList = document.getElementsByClassName("close");

for (var i = 0; i < popupList.length; i++) {
  popupList[i].addEventListener('click', function (e) {
    e.target.parentNode.classList.toggle("active");
  }, false);
}

for (var i = 0; i < modalList.length; i++) {
  modalList[i].addEventListener('click', function (e) {
    e.target.parentNode.parentNode.classList.toggle("active");
  }, false);
}

for (var i = 0; i < closeBtnList.length; i++) {
  closeBtnList[i].addEventListener('click', function (e) {
    e.target.parentNode.parentNode.parentNode.parentNode.classList.toggle("active");
  }, false);
}