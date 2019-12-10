function validateForm() {
    alert("Reservasi ditambahkan");
}

function validateForm2() {
    var x = document.forms["reservasi"]["id_user"].value;
    if (x == "") {
        alert("id_user must be filled out");
        return false;
    }
    else {
        alert("Register success!")
    }
}

function validateForm3() {
    alert("Data berhasil dihapus");
}