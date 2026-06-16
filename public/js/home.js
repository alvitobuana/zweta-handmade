
// FAQ toggle sederhana
document.querySelectorAll(".faq-item").forEach(item=>{
    item.addEventListener("click",()=>{
        alert(item.innerText);
    });
});