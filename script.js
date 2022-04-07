let b1 = document.getElementById('b1');
let b2 = document.getElementById('b2');
let b3 = document.getElementById('b3');
let p1 = document.getElementById('p1');
let timeoutId;

b1.addEventListener('click', message);
b2.addEventListener('click', stopDelai);
b3.addEventListener('click', afficheHeure);

function message(){
	var test = new XMLHttpRequest();
  timeoutId = setTimeout(alert, 1000, 'Une requête GET a été envoyé');
	
}




function stopDelai(){
    clearTimeout(timeoutId);
}

function afficheHeure(){
    setInterval(function(){
        let d = new Date();
        p1.innerHTML = d.toLocaleTimeString();
    }, 1000)
}