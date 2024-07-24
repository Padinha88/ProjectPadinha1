//Controla a exibição e ocultação de um vídeo enquanto também oculta a visibildade das
//redes sociais e do texto secundário.

function mostravideo() {
    var video = document.getElementById("video");
    var botao = document.getElementById("botao_video");
    var botao2 = document.getElementById("botao_video2");
    var social = document.getElementById("social");
    var text_sec = document.getElementById("text_sec");

    
    video.src = "movie.mp4";
    video.style.visibility='visible';
    botao2.style.visibility='visible';
    botao2.style.transform = "rotate(180deg)";
    social.style.visibility = "hidden";
    text_sec.style.visibility = "hidden";


    video.load();
    video.play();
}  


function escondevideo() {
    var video = document.getElementById("video");
    var botao = document.getElementById("botao_video");
    var botao2 = document.getElementById("botao_video2");
    var social = document.getElementById("social");
    var text_sec = document.getElementById("text_sec");

    video.style.visibility='hidden';
    botao2.style.visibility='hidden';
    social.style.visibility = "visible";
    text_sec.style.visibility = "visible";
    

    video.load();
}    