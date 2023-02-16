function darkmode() {
  var body = document.body;
  var toggle = document.getElementsByClassName("toggleDiv");
  console.log(toggle);

  body.classList.toggle("dark");
  toggle[0].classList.toggle("dark");
}
