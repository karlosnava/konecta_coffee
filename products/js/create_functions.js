
// Previsualizar imagenes antes de ser cargadas
const preview = (file) => {
  const fr = new FileReader();
  fr.onload = () => {
    const img = document.createElement("img");
    img.src = fr.result;  // String Base64 
    img.alt = file.name;
    img.classList.add("w-full","rounded-md","object-cover","object-center","h-32");
    document.querySelector('#preview').append(img);
  };
  fr.readAsDataURL(file);
};

document.querySelector("#files").addEventListener("change", (ev) => {
  if (!ev.target.files) return; // Do nothing.
  [...ev.target.files].forEach(preview);
});

// Permitir solo numeros
function onlyNumberKey(evt) {
  var ASCIICode = (evt.which) ? evt.which : evt.keyCode
  if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
    return false;
  return true;
}