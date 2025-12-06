/******/ (() => { // webpackBootstrap
/*!*********************************************************!*\
  !*** ./platform/themes/shopwise/assets/js/dk-custom.js ***!
  \*********************************************************/
document.addEventListener("DOMContentLoaded", function () {
  var contactCols = document.querySelectorAll('.dk-contact-form .contact-form-row .contact-column-6');
  if (contactCols.length > 0) {
    var lastContactCol = contactCols[contactCols.length - 1];
    if (contactCols.length % 2 !== 0) {
      lastContactCol.classList.remove("contact-column-6", "col-md-6");
      lastContactCol.classList.add("contact-column-12", "col-md-12");
    }
  }
  var compareRow = document.querySelectorAll('tr');
  console.log(compareRow);
});
/******/ })()
;