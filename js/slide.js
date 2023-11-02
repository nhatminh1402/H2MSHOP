const arrImg = [
    "hinh-1.png", "hinh-2.png", "hinh-3.png"
]

let currentIndex = 0;

function forward() {
    currentIndex++;
    if(currentIndex >= arrImg.length) currentIndex = 0
    document.querySelector("#mySlide").src = "../anh/slide/" + arrImg[currentIndex];
}

function back() {
    currentIndex--;
    if(currentIndex < 0) currentIndex = arrImg.length - 1
    document.querySelector("#mySlide").src = "../anh/slide/" + arrImg[currentIndex];
}

let t 

function start() {
    t = setInterval(forward, 3000)
}

function stop() {
    clearInterval(t);
}

start()