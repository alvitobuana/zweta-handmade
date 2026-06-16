
// simple thumbnail effect demo
document.querySelectorAll(".thumbs div").forEach((el)=>{
    el.addEventListener("click",()=>{
        document.querySelector(".main-img").style.background = "#EAD8C8";
    });
});