$(document).ready(function(){
    // Create Post Page
    let image = document.getElementById('image');
    let nameContainer = document.getElementById('image-name-container');
    let media = document.getElementById('media');
    let mediaContainer = document.getElementById('media-name-container');
    const resetBtn = document.getElementById('reset-btn');
    const form = document.getElementById('post-form');

    // Show name and file format in upload area
    image.addEventListener('change', (e) => {
        let fileName = e.target.files[0].name;
        nameContainer.innerText = fileName;
    });

    // Show media name and file format in upload area
    media.addEventListener('change', (e) => {
        let fileName = e.target.files[0].name;
        mediaContainer.innerText = fileName;
    });

    resetBtn.addEventListener('click', (e) => {
        e.preventDefault();
        form.reset();
        nameContainer.innerText = '';
        mediaContainer.innerText = '';
    });


});