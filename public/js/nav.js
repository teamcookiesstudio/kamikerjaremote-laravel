/*eslint-env browser*/

var body = document.getElementsByTagName("BODY")[0];

var btnUser = document.getElementById("user-action");
var userActions = document.getElementById("actions");
var clickCounter = 0;

btnUser.onclick = function (e) {
  e.stopPropagation();
  userActions.style.display = "flex";
}

window.onclick = function () {
  userActions.style.display = "none";
}