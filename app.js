const titre = document.querySelector('h1');
const texte = document.querySelector('ul');
const soustitre = document.querySelector('h2');
const image = document.querySelector('.imageheader');

const timeline1 = new TimelineMax({paused: true});

timeline1
.from(titre, 1, {y : -100, opacity: 0})
.from(soustitre, 1, {y : 100, opacity: 0}, '-=0.4')
.from(texte, 1, {opacity: 0}, '-=0.4')
.from(image, 1, {x : 100, opacity: 0}, '-=0.4')

timeline1.play();