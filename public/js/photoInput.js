let current_id;
let current_preview;

if (!id) {
    current_id = "photoInput";
} else {
    current_id = id;
}

if (!preview) {
    current_preview = "photoPreview";
} else {
    current_preview = preview;
}

document.getElementById(current_id).addEventListener("change", function (e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById(current_preview).src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});
