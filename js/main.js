'use strict'
const url = 'http://localhost:3000/777';

let el = document.getElementsByClassName('tree')

// el.style.cssText = 'width: 200px; height: 200px; background: #ddd'

window.onload = () => {
  fetch(url)
    .then(data => data.text())
    .then(res=>document.write(res))
}
