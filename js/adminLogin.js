let inputField = document.querySelectorAll("input[type=email], input[type=password]")

inputField.forEach(input => {
    input.addEventListener("input", function(){
        let errorTag = input.parentElement.querySelector("span")
        errorTag.innerText = ""
    })
})



  