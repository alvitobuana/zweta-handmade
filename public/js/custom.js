// preview click effect (simple UX feedback)
document.querySelectorAll("input, textarea").forEach(el=>{
    el.addEventListener("focus",()=>{
        el.style.border = "1px solid #A56A43";
    });

    el.addEventListener("blur",()=>{
        el.style.border = "1px solid #e0cbb7";
    });
});