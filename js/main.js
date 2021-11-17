


function validateForm() {
  let x = document.forms["createOrder"]["fname"].value;
  if (x == "") {
    alert("Name must be filled out");
    return false;
  }
  console.log('xxx:', x);
  console.log("Hello world!");

}