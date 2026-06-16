
// ================= REGISTER =================
function register(){

    let name = document.getElementById("name").value;
    let email = document.getElementById("email").value;
    let wa = document.getElementById("wa").value;
    let password = document.getElementById("password").value;

    if(name === "" || email === "" || wa === "" || password === ""){
        alert("Semua field wajib diisi!");
        return;
    }

    // simulasi register
    alert("Register berhasil!");

    window.location.href = "/login";
}

// ================= LOGIN =================
function login(){

    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;

    if(email === "" || password === ""){
        alert("Isi email & password!");
        return;
    }

    alert("Login sukses!");
    window.location.href = "/profile";
}