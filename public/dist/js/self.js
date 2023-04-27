let valueDisplays = document.querySelectorAll(".num");
const interval = 5000;

valueDisplays.forEach((value) => {
    let startValue = 0;
    let endValue = parseInt(value.getAttribute("data-val"));
    let duration = Math.floor(interval / endValue);

    let counter = setInterval(() => {
        startValue += 1;
        value.textContent = startValue;
        startValue == endValue && clearInterval(counter);
    }, duration);
});

const image = document.getElementById("img");
const inputtedImage = document.getElementById("image");

inputtedImage.addEventListener("change", () => {
    image.src = URL.createObjectURL(inputtedImage.files[0]);
});
