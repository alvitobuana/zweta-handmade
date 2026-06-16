const radios = document.querySelectorAll('input[name="pay"]');
const qrBox = document.getElementById('qrisBox');

radios.forEach(radio=>{
    radio.addEventListener('change',()=>{
        if(radio.value === "qris"){
            qrBox.innerText = "QRIS";
        }
        else if(radio.value === "transfer"){
            qrBox.innerText = "BANK";
        }
        else{
            qrBox.innerText = "COD";
        }
    });
});