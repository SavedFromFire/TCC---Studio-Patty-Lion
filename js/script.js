let cropImage = document.getElementById("crop-image");
let overlay = document.getElementById("overlay");
let editFotoContainer = document.getElementById("edit-foto-container");
let posX = 0, posY = 0, startX, startY;

// Abre a interface de edição
function openEditFoto() {
    overlay.style.display = "block";
    editFotoContainer.style.display = "block";
    posX = 0;
    posY = 0;
    cropImage.style.transform = `translate(-50%, -50%)`; // Centraliza a imagem ao abrir
}

// Fecha a interface de edição
function closeEditFoto() {
    overlay.style.display = "none";
    editFotoContainer.style.display = "none";
}

// Previsualiza a imagem selecionada
function previewImage(event) {
    let reader = new FileReader();
    reader.onload = function () {
        cropImage.src = reader.result;

        // Reseta a posição e tamanho da imagem para centralizar
        cropImage.style.transform = `translate(-50%, -50%)`;
        cropImage.style.width = "auto";
        cropImage.style.height = "100%"; // Garante que a imagem preencha o círculo verticalmente
    }
    reader.readAsDataURL(event.target.files[0]);
}

// Mover a imagem ao arrastar
cropImage.addEventListener("mousedown", function (e) {
    startX = e.clientX - posX;
    startY = e.clientY - posY;
    document.addEventListener("mousemove", onMouseMove);
    document.addEventListener("mouseup", onMouseUp);
});

function onMouseMove(e) {
    posX = e.clientX - startX;
    posY = e.clientY - startY;
    cropImage.style.transform = `translate(calc(-50% + ${posX}px), calc(-50% + ${posY}px))`;
}

function onMouseUp() {
    document.removeEventListener("mousemove", onMouseMove);
    document.removeEventListener("mouseup", onMouseUp);
}

// Salvar a imagem (com envio ao servidor)
function saveImage() {
    let fileInput = document.getElementById("file-input");
    if (fileInput.files.length === 0) {
        alert("Por favor, selecione uma imagem.");
        return;
    }

    let formData = new FormData();
    formData.append('foto_perfil', fileInput.files[0]);

    fetch('salvar_foto.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Atualiza a imagem na página do perfil
            document.getElementById("profile-photo").src = data.file_path + "?v=" + new Date().getTime();
            closeEditFoto();
        } else {
            alert("Erro: " + data.message);
        }
    })
    .catch(error => console.error("Erro:", error));
}
