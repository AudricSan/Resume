console.log('Hello dark mode')

const toggle = document.querySelector('.toggle');

const hours = new Date().getHours();
toggle.checked = hours > 7 && hours < 20;