function increment(event, i) {
  document.getElementById("qty" + i).value++;
  event.preventDefault();
}

function decrement(event, i) {
  if (document.getElementById("qty" + i).value > 0) {
    document.getElementById("qty" + i).value--;
    event.preventDefault();
  } else {
    event.preventDefault();
  }
}
